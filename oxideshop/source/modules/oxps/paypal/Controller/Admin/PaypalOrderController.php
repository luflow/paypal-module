<?php

/**
 * This file is part of OXID eSales Paypal module.
 *
 * OXID eSales Paypal module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales Paypal module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eSales Paypal module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2020
 */

namespace OxidProfessionalServices\PayPal\Controller\Admin;

use OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidProfessionalServices\PayPal\Api\Exception\ApiException;
use OxidProfessionalServices\PayPal\Api\Model\Orders\Order as PayPalOrder;
use OxidProfessionalServices\PayPal\Api\Model\Payments\Capture;
use OxidProfessionalServices\PayPal\Api\Model\Payments\RefundRequest;
use OxidProfessionalServices\PayPal\Api\Service\Orders;
use OxidProfessionalServices\PayPal\Api\Service\Payments;
use OxidProfessionalServices\PayPal\Core\ServiceFactory;

/**
 * Order class wrapper for PayPal module
 */
class PaypalOrderController extends AdminDetailsController
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * @var PayPalOrder
     */
    protected $payPalOrder;

    /**
     * Executes parent method parent::render(), creates oxOrder object,
     * passes it's data to Smarty engine and returns
     * name of template file "paypalorder.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        $this->_aViewData['oxid'] = $this->getEditObjectId();
        $this->_aViewData['order'] = $order = $this->getOrder();
        $this->_aViewData['payPalOrder'] = $order->paidWithPayPal() ? $this->getPayPalOrder() : null;

        return "paypalorder.tpl";
    }

    /**
     * Refunds order payment
     */
    public function refund(): void
    {
        $request = Registry::getRequest();
        $refundAmount = $request->getRequestEscapedParameter('refundAmount');
        $invoiceId = $request->getRequestEscapedParameter('invoiceId');
        $refundAll = $request->getRequestEscapedParameter('refundAll');
        $noteToPayer = $request->getRequestParameter('noteToPayer');

        $capture = $this->getOrderPaymentCapture();
        $request = new RefundRequest();

        if (!$refundAll) {
            $request->initAmount();
            $request->amount->currency_code = $capture->amount->currency_code;
            $request->amount->value = $refundAmount;
            $request->invoice_id = $invoiceId;
            $request->note_to_payer = $noteToPayer;
        }

        /** @var Payments $paymentService */
        $paymentService = Registry::get(ServiceFactory::class)->getPaymentService();
        $response = $paymentService->refundCapturedPayment($capture->id, $refundAll, '');
    }

    /**
     * Get PayPal order object for the active order
     *
     * @return PayPalOrder
     * @throws StandardException|ApiException
     */
    protected function getPayPalOrder(): PayPalOrder
    {
        if (!$this->payPalOrder) {
            $order = $this->getOrder();
            if (!$order->paidWithPayPal()) {
                throw new StandardException('Order not paid using PayPal');
            }
            /** @var Orders $orderService */
            $orderService = Registry::get(ServiceFactory::class)->getOrderService();
            $this->payPalOrder = $orderService->showOrderDetails($order->getPayPalOrderId());
        }

        return $this->payPalOrder;
    }

    /**
     * Get active order
     *
     * @return Order
     * @throws StandardException
     */
    protected function getOrder(): Order
    {
        if (!$this->order) {
            $order = oxNew(Order::class);
            $orderId = $this->getEditObjectId();
            if ($orderId === null || !$order->load($orderId)) {
                throw new StandardException('Order not found');
            }
            $this->order = $order;
        }

        return $this->order;
    }

    /**
     * Get order payment capture id
     *
     * @return Capture
     * @throws StandardException|ApiException
     */
    protected function getOrderPaymentCapture(): Capture
    {
        return $this->getPayPalOrder()->purchase_units[0]->payments->captures[0];
    }
}
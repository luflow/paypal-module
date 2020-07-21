<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The order request details.
 */
class OrderRequest implements JsonSerializable
{
    use BaseModel;

    /**
     * @var string
     * The intent to either capture payment immediately or authorize a payment for an order after order creation.
     */
    public $intent;

    /**
     * @var string
     * The instruction to process an order.
     */
    public $processing_instruction;

    /**
     * @var Payer
     * The customer who approves and pays for the order. The customer is also known as the payer.
     */
    public $payer;

    /** @var array<PurchaseUnitRequest> */
    public $purchase_units;

    /**
     * @var PaymentSource
     * The payment source definition.
     */
    public $payment_source;

    /**
     * @var OrderApplicationContext
     * Customizes the payer experience during the approval process for the payment with
     * PayPal.<blockquote><strong>Note:</strong> Partners and Marketplaces might configure <code>brand_name</code>
     * and <code>shipping_preference</code> during partner account setup, which overrides the request
     * values.</blockquote>
     */
    public $application_context;
}

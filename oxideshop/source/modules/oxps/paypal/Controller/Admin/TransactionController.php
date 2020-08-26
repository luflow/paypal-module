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

use DateInterval;
use DateTime;
use Exception;
use OxidEsales\Eshop\Application\Controller\Admin\AdminListController;
use OxidEsales\Eshop\Core\Registry;
use OxidProfessionalServices\PayPal\Api\Exception\ApiException;
use OxidProfessionalServices\PayPal\Api\Model\TransactionSearch\SearchResponse;
use OxidProfessionalServices\PayPal\Api\Model\TransactionSearch\TransactionDetail;
use OxidProfessionalServices\PayPal\Core\Currency;
use OxidProfessionalServices\PayPal\Core\ServiceFactory;
use OxidProfessionalServices\PayPal\Core\TransactionEventCodes;

class TransactionController extends AdminListController
{
    private const DEFAULT_LIST_SIZE = 100;

    /**
     * @var SearchResponse|null
     */
    protected $response;

    /**
     * Current class template name.
     *
     * @var string
     */
    protected $_sThisTemplate = 'paypal_transactions.tpl';

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->requestTransactions();

        return parent::render();
    }

    /**
     * Gets transaction information with applied filters.
     *
     * @return TransactionDetail[]|null
     */
    public function getTransactions(): array
    {
        $transactions = [];
        $response = $this->response;

        if ($response && is_array($response->transaction_details)) {
                $transactions = $response->transaction_details;
        }

        return $transactions;
    }

    /**
     * Fetches filtered transaction data
     *
     * @noinspection PhpUndefinedVariableInspection
     */
    protected function requestTransactions()
    {
        /** @var ServiceFactory $serviceFactory */
        $serviceFactory = Registry::get(ServiceFactory::class);
        $transactionService = $serviceFactory->getTransactionSearchService();
        extract($this->buildPayPalFilterParameters());

        try {
            $this->response = $transactionService->listTransactions(
                $transactionId,
                $transactionType,
                $transactionStatus,
                $transactionAmount,
                $transactionCurrency,
                $transactionDate,
                $startDate,
                $endDate,
                $paymentInstrumentType,
                $storeId,
                $terminalId,
                $this->getActivePage(),
                $this->getViewListSize(),
                $balanceAffectingRecordsOnly
            );
        } catch (ApiException $exception) {
            $this->response = null;
            Registry::getLogger()->error('Error when fetching transaction data', [$exception]);
        }
    }

    /**
     * Gets filter parameters
     *
     * @return array
     */
    public function getFilterValues(): array
    {
        $filters = $this->getListFilter();

        //Text input filters
        $textFilterKeys = [
            'transactionId',
            'transactionType',
            'transactionStatus',
            'transactionCurrency',
            'paymentInstrumentType',
            'balanceAffectingRecordsOnly',
            'terminalId',
            'storeId',
            'fromPrice',
            'toPrice'
        ];

        $textFilterValues = array_map(function ($filterKey) use ($filters) {
            if ($filterValue = (string) $filters['transactions'][$filterKey]) {
                return trim($filterValue);
            }
            return null;
        }, $textFilterKeys);

        $textFilters = array_combine($textFilterKeys, $textFilterValues);

        //Date input filters
        $dateFilterKeys = [
            'transactionDate',
            'startDate',
            'endDate',
        ];

        $dateFilterValues = array_map(function ($filterKey) use ($filters) {
            if ($filterValue = (string) $filters['transactions'][$filterKey]) {
                try {
                    $date = new DateTime($filterValue);
                    return $date->format(DATE_ISO8601);
                } catch (Exception $exception) {
                    return null;
                }
            }
            return null;
        }, $dateFilterKeys);

        return $this->setDefaultFilterValues(
            array_merge(
                $textFilters,
                array_combine($dateFilterKeys, $dateFilterValues)
            )
        );
    }

    /**
     * @param array $filters
     *
     * @return array
     */
    protected function buildPayPalFilterParameters(): array
    {
        $filters = $this->getFilterValues();

        if (
            !empty($filters['fromPrice'])
            && is_numeric($filters['fromPrice'])
            && !empty($filters['toPrice'])
            && is_numeric($filters['toPrice'])
        ) {
            $fromPrice = $filters['fromPrice'];
            $toPrice = $filters['toPrice'];
            $currency = $filters['transactionCurrency'];

            $filters['$transactionAmount'] =
                sprintf(
                    '%s TO %s',
                    Currency::formatAmountInLowestDenominator($fromPrice, $currency),
                    Currency::formatAmountInLowestDenominator($toPrice, $currency)
                );
        } else {
            unset($filters['fromPrice']);
            unset($filters['toPrice']);
        }

        return $filters;
    }

    /**
     * Get PayPal event codes
     *
     * @return \string[][]
     */
    public function getEventCodes()
    {
        return TransactionEventCodes::EVENT_CODES;
    }

    /**
     * Sets default values for required parameters
     *
     * @param array $filters
     *
     * @return array
     */
    protected function setDefaultFilterValues(array $filters): array
    {
        //Setting default date values on initial page load
        if (empty($filters['startDate']) && empty($filters['endDate'])) {
            $utilsDate = Registry::getUtilsDate();
            //Maximum period of one month can be requested
            $today = new DateTime();
            $today->setTimestamp($utilsDate->getTime());
            $previousMonth = clone $today;
            $previousMonth->sub(new DateInterval('P1M'));

            $filters['startDate'] = $previousMonth->format(DateTime::ISO8601);
            $filters['endDate'] = $today->format(DateTime::ISO8601);
        }

        //Use 0 FROM price in case only TO price is provided
        if (empty($filters['fromPrice']) && !empty($filters['toPrice'])) {
            $filters['fromPrice'] = 0;
        }

        return $filters;
    }

    /**
     * Set parameters needed for list navigation
     */
    protected function _setListNavigationParams()
    {
        if ($response = $this->response) {
            $this->_iListSize = $response->total_items;
            $this->_iCurrListPos = ($response->page - 1) * $this->getViewListSize();
        }

        parent::_setListNavigationParams();
    }

    /**
     * Get active page number
     *
     * @return int
     */
    protected function getActivePage(): int
    {
        $page = (int) Registry::getRequest()->getRequestEscapedParameter('jumppage');

        return $page > 0 ? $page : 1;
    }

    /**
     * @inheritDoc
     */
    protected function _getViewListSize()
    {
        return self::DEFAULT_LIST_SIZE;
    }
}

<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The recurring billing canceled details.
 *
 * generated from: response-canceled_recurring_billing.json
 */
class CanceledRecurringBilling implements JsonSerializable
{
    use BaseModel;

    /**
     * @var Money
     * The currency and amount for a financial transaction, such as a balance or payment due.
     */
    public $expected_refund;

    /**
     * @var CancellationDetails
     * The cancellation details.
     */
    public $cancellation_details;

    public function validate()
    {
        assert(isset($this->expected_refund));
    }
}

<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Subscriptions;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The billing details for the subscription. If the subscription was or is active, these fields are populated.
 */
class SubscriptionBillingInfo implements JsonSerializable
{
    use BaseModel;

    /** @var Money */
    public $outstanding_balance;

    /** @var array<CycleExecution> */
    public $cycle_executions;

    /** @var LastPaymentDetails */
    public $last_payment;

    /** @var string */
    public $next_billing_time;

    /** @var Money */
    public $next_payment;

    /** @var string */
    public $final_payment_time;

    /** @var integer */
    public $failed_payments_count;

    /** @var FailedPaymentDetails */
    public $last_failed_payment;

    /** @var Money */
    public $total_paid_amount;
}

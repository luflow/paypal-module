<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * Payment context data required for processing payments for an order.
 */
class PaymentContextData implements JsonSerializable
{
    use BaseModel;

    /**
     * @var string
     * The intent to either capture payment immediately or authorize a payment for an order after order creation.
     */
    public $intent;

    /**
     * @var OrderApplicationContext
     * Customizes the payer experience during the approval process for the payment with
     * PayPal.<blockquote><strong>Note:</strong> Partners and Marketplaces might configure <code>brand_name</code>
     * and <code>shipping_preference</code> during partner account setup, which overrides the request
     * values.</blockquote>
     */
    public $application_context;

    /** @var array<Facilitator> */
    public $facilitators;

    /** @var array<PaymentUnit> */
    public $payment_units;
}

<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Subscriptions;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The customer and merchant payment preferences.
 */
class PaymentMethod implements JsonSerializable
{
    use BaseModel;

    /** @var string */
    public $payer_selected;

    /** @var string */
    public $payee_preferred;

    /** @var string */
    public $category;
}

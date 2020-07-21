<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Subscriptions;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The method by which the payer wants to get their items.
 */
class ShippingType implements JsonSerializable
{
    use BaseModel;
}

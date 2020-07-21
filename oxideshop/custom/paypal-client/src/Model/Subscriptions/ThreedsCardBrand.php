<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Subscriptions;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * Card brand that the transaction was processed for authentication.
 */
class ThreedsCardBrand implements JsonSerializable
{
    use BaseModel;
}

<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Partner;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The customer-provided consent.
 */
class LegalConsent implements JsonSerializable
{
    use BaseModel;

    /** @var string */
    public $type;

    /** @var boolean */
    public $granted;
}

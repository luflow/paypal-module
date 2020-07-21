<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Payments;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The details of the captured payment status.
 */
class CaptureStatusDetails implements JsonSerializable
{
    use BaseModel;

    /** @var string */
    public $reason;
}

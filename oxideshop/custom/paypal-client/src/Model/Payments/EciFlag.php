<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Payments;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * Electronic Commerce Indicator (ECI). The ECI value is part of the 2 data elements that indicate the
 * transaction was processed electronically. This should be passed on the authorization transaction to the
 * Gateway/Processor.
 */
class EciFlag implements JsonSerializable
{
    use BaseModel;
}

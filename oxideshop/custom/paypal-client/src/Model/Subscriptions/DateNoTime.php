<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Subscriptions;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The stand-alone date, in [Internet date and time format](https://tools.ietf.org/html/rfc3339#section-5.6). To
 * represent special legal values, such as a date of birth, you should use dates with no associated time or
 * time-zone data. Whenever possible, use the standard `date_time` type. This regular expression does not
 * validate all dates. For example, February 31 is valid and nothing is known about leap years.
 */
class DateNoTime implements JsonSerializable
{
    use BaseModel;
}

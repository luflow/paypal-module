<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Partner;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The phone number in its canonical international [E.164 numbering plan
 * format](https://www.itu.int/rec/T-REC-E.164/en).
 *
 * generated from: customer_common-v1-schema-common_components-v4-schema-json-openapi-2.0-phone.json
 */
class Phone implements JsonSerializable
{
    use BaseModel;

    /**
     * @var string
     * The country calling code (CC), in its canonical international [E.164 numbering plan
     * format](https://www.itu.int/rec/T-REC-E.164/en). The combined length of the CC and the national number must
     * not be greater than 15 digits. The national number consists of a national destination code (NDC) and
     * subscriber number (SN).
     *
     * minLength: 1
     * maxLength: 3
     */
    public $country_code;

    /**
     * @var string
     * The national number, in its canonical international [E.164 numbering plan
     * format](https://www.itu.int/rec/T-REC-E.164/en). The combined length of the country calling code (CC) and the
     * national number must not be greater than 15 digits. The national number consists of a national destination
     * code (NDC) and subscriber number (SN).
     *
     * minLength: 1
     * maxLength: 14
     */
    public $national_number;

    /**
     * @var string
     * The extension number.
     *
     * minLength: 1
     * maxLength: 15
     */
    public $extension_number;

    public function validate()
    {
        assert(!isset($this->country_code) || strlen($this->country_code) >= 1);
        assert(!isset($this->country_code) || strlen($this->country_code) <= 3);
        assert(!isset($this->national_number) || strlen($this->national_number) >= 1);
        assert(!isset($this->national_number) || strlen($this->national_number) <= 14);
        assert(!isset($this->extension_number) || strlen($this->extension_number) >= 1);
        assert(!isset($this->extension_number) || strlen($this->extension_number) <= 15);
    }
}

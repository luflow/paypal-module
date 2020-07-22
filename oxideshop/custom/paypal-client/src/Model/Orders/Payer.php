<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The customer who approves and pays for the order. The customer is also known as the payer.
 *
 * generated from: MerchantsCommonComponentsSpecification-v1-schema-payer.json
 */
class Payer implements JsonSerializable
{
    use BaseModel;

    /**
     * @var Name
     * The name of the party.
     */
    public $name;

    /**
     * @var string
     * The internationalized email address.<blockquote><strong>Note:</strong> Up to 64 characters are allowed before
     * and 255 characters are allowed after the <code>@</code> sign. However, the generally accepted maximum length
     * for an email address is 254 characters. The pattern verifies that an unquoted <code>@</code> sign
     * exists.</blockquote>
     *
     * maxLength: 254
     */
    public $email_address;

    /**
     * @var string
     * The account identifier for a PayPal account.
     *
     * minLength: 13
     * maxLength: 13
     */
    public $payer_id;

    /**
     * @var PhoneWithType
     * The phone information.
     */
    public $phone;

    /**
     * @var string
     * The stand-alone date, in [Internet date and time format](https://tools.ietf.org/html/rfc3339#section-5.6). To
     * represent special legal values, such as a date of birth, you should use dates with no associated time or
     * time-zone data. Whenever possible, use the standard `date_time` type. This regular expression does not
     * validate all dates. For example, February 31 is valid and nothing is known about leap years.
     *
     * minLength: 10
     * maxLength: 10
     */
    public $birth_date;

    /**
     * @var TaxInfo
     * The tax ID of the customer. The customer is also known as the payer. Both `tax_id` and `tax_id_type` are
     * required.
     */
    public $tax_info;

    /**
     * @var AddressPortable
     * The portable international postal address. Maps to
     * [AddressValidationMetadata](https://github.com/googlei18n/libaddressinput/wiki/AddressValidationMetadata) and
     * HTML 5.1 [Autofilling form controls: the autocomplete
     * attribute](https://www.w3.org/TR/html51/sec-forms.html#autofilling-form-controls-the-autocomplete-attribute).
     */
    public $address;

    public function validate()
    {
        assert(!isset($this->email_address) || strlen($this->email_address) <= 254);
        assert(!isset($this->payer_id) || strlen($this->payer_id) >= 13);
        assert(!isset($this->payer_id) || strlen($this->payer_id) <= 13);
        assert(isset($this->phone));
        assert(!isset($this->birth_date) || strlen($this->birth_date) >= 10);
        assert(!isset($this->birth_date) || strlen($this->birth_date) <= 10);
        assert(isset($this->tax_info));
        assert(isset($this->address));
    }
}

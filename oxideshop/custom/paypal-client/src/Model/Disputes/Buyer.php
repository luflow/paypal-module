<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The details for the customer who funds the payment. For example, the customer's first name, last name, and
 * email address.
 *
 * generated from: response-buyer.json
 */
class Buyer implements JsonSerializable
{
    use BaseModel;

    /**
     * @var string
     * The internationalized email address.<blockquote><strong>Note:</strong> Up to 64 characters are allowed before
     * and 255 characters are allowed after the <code>@</code> sign. However, the generally accepted maximum length
     * for an email address is 254 characters. The pattern verifies that an unquoted <code>@</code> sign
     * exists.</blockquote>
     *
     * minLength: 3
     * maxLength: 254
     */
    public $email;

    /**
     * @var string
     * The PayPal payer ID, which is a masked version of the PayPal account number intended for use with third
     * parties. The account number is reversibly encrypted and a proprietary variant of Base32 is used to encode the
     * result.
     *
     * minLength: 13
     * maxLength: 13
     */
    public $payer_id;

    /**
     * @var string
     * The customer's name.
     *
     * minLength: 1
     * maxLength: 2000
     */
    public $name;

    public function validate()
    {
        assert(!isset($this->email) || strlen($this->email) >= 3);
        assert(!isset($this->email) || strlen($this->email) <= 254);
        assert(!isset($this->payer_id) || strlen($this->payer_id) >= 13);
        assert(!isset($this->payer_id) || strlen($this->payer_id) <= 13);
        assert(!isset($this->name) || strlen($this->name) >= 1);
        assert(!isset($this->name) || strlen($this->name) <= 2000);
    }
}

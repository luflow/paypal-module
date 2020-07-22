<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The currency and amount for a financial transaction, such as a balance or payment due.
 *
 * generated from: common_components-v3-schema-json-openapi-2.0-money.json
 */
class Money implements JsonSerializable
{
    use BaseModel;

    /**
     * @var string
     * The [three-character ISO-4217 currency code](/docs/integration/direct/rest/currency-codes/) that identifies
     * the currency.
     *
     * minLength: 3
     * maxLength: 3
     */
    public $currency_code;

    /**
     * @var string
     * The value, which might be:<ul><li>An integer for currencies like `JPY` that are not typically
     * fractional.</li><li>A decimal fraction for currencies like `TND` that are subdivided into
     * thousandths.</li></ul>For the required number of decimal places for a currency code, see [Currency codes - ISO
     * 4217](https://www.iso.org/iso-4217-currency-codes.html).
     *
     * maxLength: 32
     */
    public $value;

    public function validate()
    {
        assert(!isset($this->currency_code) || strlen($this->currency_code) >= 3);
        assert(!isset($this->currency_code) || strlen($this->currency_code) <= 3);
        assert(!isset($this->value) || strlen($this->value) <= 32);
    }
}

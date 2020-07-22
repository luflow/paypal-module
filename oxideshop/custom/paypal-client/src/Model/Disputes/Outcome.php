<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The outcome of the dispute case.
 *
 * generated from: referred-outcome.json
 */
class Outcome implements JsonSerializable
{
    use BaseModel;

    /** The customer is at fault. */
    const FAULTY_PARTY_BUYER = 'BUYER';

    /** The merchant is at fault. */
    const FAULTY_PARTY_SELLER = 'SELLER';

    /** The partner is at fault. */
    const FAULTY_PARTY_PARTNER = 'PARTNER';

    /** No specific party is at fault. */
    const FAULTY_PARTY_NONE = 'NONE';

    /**
     * @var string
     * The party that was at fault.
     *
     * use one of constants defined in this class to set the value:
     * @see FAULTY_PARTY_BUYER
     * @see FAULTY_PARTY_SELLER
     * @see FAULTY_PARTY_PARTNER
     * @see FAULTY_PARTY_NONE
     * minLength: 1
     * maxLength: 255
     */
    public $faulty_party;

    /**
     * @var string
     * The reason for the decision.
     *
     * minLength: 1
     * maxLength: 2000
     */
    public $adjudication_reason;

    /**
     * @var string
     * The date and time, in [Internet date and time format](https://tools.ietf.org/html/rfc3339#section-5.6).
     * Seconds are required while fractional seconds are optional.<blockquote><strong>Note:</strong> The regular
     * expression provides guidance but does not reject all invalid dates.</blockquote>
     *
     * minLength: 20
     * maxLength: 64
     */
    public $resolution_date;

    public function validate()
    {
        assert(!isset($this->faulty_party) || strlen($this->faulty_party) >= 1);
        assert(!isset($this->faulty_party) || strlen($this->faulty_party) <= 255);
        assert(!isset($this->adjudication_reason) || strlen($this->adjudication_reason) >= 1);
        assert(!isset($this->adjudication_reason) || strlen($this->adjudication_reason) <= 2000);
        assert(!isset($this->resolution_date) || strlen($this->resolution_date) >= 20);
        assert(!isset($this->resolution_date) || strlen($this->resolution_date) <= 64);
    }
}

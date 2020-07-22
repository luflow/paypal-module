<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Partner;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * Name of the business provided.
 *
 * generated from: customer_common-v1-schema-account_model-business_name_detail.json
 */
class BusinessNameDetail extends BusinessName implements JsonSerializable
{
    use BaseModel;

    /** The trading name of the business. */
    const TYPE_DOING_BUSINESS_AS = 'DOING_BUSINESS_AS';

    /** The legal name of the business. */
    const TYPE_LEGAL_NAME = 'LEGAL_NAME';

    /**
     * @var string
     * The encrypted ID for the business name.
     *
     * minLength: 1
     * maxLength: 20
     */
    public $id;

    /**
     * @var string
     * Business name type
     *
     * use one of constants defined in this class to set the value:
     * @see TYPE_DOING_BUSINESS_AS
     * @see TYPE_LEGAL_NAME
     * minLength: 1
     * maxLength: 255
     */
    public $type;

    public function validate()
    {
        assert(!isset($this->id) || strlen($this->id) >= 1);
        assert(!isset($this->id) || strlen($this->id) <= 20);
        assert(!isset($this->type) || strlen($this->type) >= 1);
        assert(!isset($this->type) || strlen($this->type) <= 255);
    }
}

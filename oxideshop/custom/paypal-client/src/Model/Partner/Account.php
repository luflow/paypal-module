<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Partner;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * Common account object to hold the account related details of the customer.
 */
class Account implements JsonSerializable
{
    use BaseModel;

    /** @var array<IndividualOwner> */
    public $individual_owners;

    /**
     * @var BusinessEntity
     * The business entity of the account.
     */
    public $business_entity;
}

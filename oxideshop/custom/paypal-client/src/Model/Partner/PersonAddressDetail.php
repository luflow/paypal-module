<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Partner;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * A simple postal address with coarse-grained fields.
 */
class PersonAddressDetail extends AddressPortable implements JsonSerializable
{
    use BaseModel;

    /** The home address of the customer. */
    const TYPE_HOME = 'HOME';

    /**
     * @var string
     * The address type under which the provided address is tagged.
     *
     * use one of constants defined in this class to set the value:
     * @see TYPE_HOME
     */
    public $type;

    /** @var boolean */
    public $primary;

    /** @var boolean */
    public $inactive;
}

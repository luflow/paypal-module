<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * Additional attributes associated with the use of this paypal wallet
 */
class PaypalWalletAttributes implements JsonSerializable
{
    use BaseModel;

    /** @var Customer */
    public $customer;
}

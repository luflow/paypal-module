<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The purchase unit details. Used to capture required information for the payment contract.
 */
class PurchaseUnit implements JsonSerializable
{
    use BaseModel;

    /** @var string */
    public $reference_id;

    /** @var AmountWithBreakdown */
    public $amount;

    /** @var Payee */
    public $payee;

    /** @var PaymentInstruction */
    public $payment_instruction;

    /** @var string */
    public $description;

    /** @var string */
    public $custom_id;

    /** @var string */
    public $invoice_id;

    /** @var string */
    public $id;

    /** @var string */
    public $soft_descriptor;

    /** @var array<Item> */
    public $items;

    /** @var ShippingDetail */
    public $shipping;

    /** @var SupplementaryData */
    public $supplementary_data;

    /** @var PaymentCollection */
    public $payments;
}

<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Payments;

use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The refund information.
 */
class Refund extends RefundStatus implements \JsonSerializable
{
    use BaseModel;

    /** @var string */
    public $id;

    /** @var Money */
    public $amount;

    /** @var string */
    public $invoice_id;

    /** @var string */
    public $note_to_payer;

    /** @var OxidProfessionalServices\PayPal\Api\Model\Payments\RefundSellerPayableBreakdown */
    public $seller_payable_breakdown;

    /** @var array */
    public $links;

    /** @var string */
    public $create_time;

    /** @var string */
    public $update_time;
}

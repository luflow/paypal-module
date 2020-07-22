<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The transaction hold information.
 *
 * generated from: Extensions_transaction_hold_info
 */
class ExtensionsTransactionHoldInfo implements JsonSerializable
{
    use BaseModel;

    /**
     * @var boolean
     * Indicates whether a temporary hold must be placed on the transaction.
     */
    public $hold_required;

    /**
     * @var string
     * The temporary hold ID.
     *
     * minLength: 1
     * maxLength: 255
     */
    public $id;

    /**
     * @var string
     * The reason for the temporary hold on the dispute.
     *
     * minLength: 1
     * maxLength: 2000
     */
    public $reason;

    public function validate()
    {
        assert(!isset($this->id) || strlen($this->id) >= 1);
        assert(!isset($this->id) || strlen($this->id) <= 255);
        assert(!isset($this->reason) || strlen($this->reason) >= 1);
        assert(!isset($this->reason) || strlen($this->reason) <= 2000);
    }
}

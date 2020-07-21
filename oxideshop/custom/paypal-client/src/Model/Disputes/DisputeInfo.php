<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The dispute summary information.
 */
class DisputeInfo implements JsonSerializable
{
    use BaseModel;

    /** @var string */
    public $dispute_id;

    /** @var string */
    public $create_time;

    /** @var string */
    public $update_time;

    /** @var array<TransactionInfo> */
    public $disputed_transactions;

    /** @var array<AccountActivity> */
    public $disputed_account_activities;

    /** @var string */
    public $reason;

    /** @var string */
    public $status;

    /** @var string */
    public $dispute_state;

    /** @var Money */
    public $dispute_amount;

    /** @var Money */
    public $dispute_fee;

    /** @var string */
    public $external_reason_code;

    /** @var DisputeOutcome */
    public $dispute_outcome;

    /** @var string */
    public $dispute_life_cycle_stage;

    /** @var string */
    public $dispute_channel;

    /** @var array<Message> */
    public $messages;

    /** @var Extensions */
    public $extensions;

    /** @var array<Evidence> */
    public $evidences;

    /** @var string */
    public $buyer_response_due_date;

    /** @var string */
    public $seller_response_due_date;

    /** @var array<History> */
    public $history;

    /** @var string */
    public $dispute_flow;

    /** @var Offer */
    public $offer;

    /** @var RefundDetails */
    public $refund_details;

    /** @var CommunicationDetails */
    public $communication_details;

    /** @var array<PartnerAction> */
    public $partner_actions;

    /** @var array<SupportingInfo> */
    public $supporting_info;

    /** @var array<array> */
    public $links;
}

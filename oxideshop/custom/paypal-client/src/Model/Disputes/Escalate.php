<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * A merchant request to escalate a dispute, by ID, to a PayPal claim.
 *
 * generated from: request-escalate.json
 */
class Escalate implements JsonSerializable
{
    use BaseModel;

    /** The merchant indicates that shipment would have arrived by now. */
    const BUYER_ESCALATION_REASON_SHIPMENT_NOT_ARRIVED = 'SHIPMENT_NOT_ARRIVED';

    /** The customer has evidence that the merchant might be fraudulent. */
    const BUYER_ESCALATION_REASON_FRAUDULENT_SELLER = 'FRAUDULENT_SELLER';

    /** The customer already failed to reach a resolution with the merchant before filing this dispute. */
    const BUYER_ESCALATION_REASON_FAILED_NEGOTIATION = 'FAILED_NEGOTIATION';

    /** The customer thinks he or she cannot reach a resolution with the merchant. */
    const BUYER_ESCALATION_REASON_INCONCLUSIVE_NEGOTIATION = 'INCONCLUSIVE_NEGOTIATION';

    /** The customer didn't receive refund as mentioned by merchant. */
    const BUYER_ESCALATION_REASON_REFUND_NOT_RECEIVED = 'REFUND_NOT_RECEIVED';

    /** The customer received lesser refund amount than expected. */
    const BUYER_ESCALATION_REASON_REFUND_AMOUNT_IS_DIFFERENT = 'REFUND_AMOUNT_IS_DIFFERENT';

    /** Tracking id received from merchant is invalid. */
    const BUYER_ESCALATION_REASON_TRACKING_ID_INVALID = 'TRACKING_ID_INVALID';

    /** The customer has other reasons, which are described in the comments. If OTHER is specified, customer needs to specify more information in the notes field. */
    const BUYER_ESCALATION_REASON_OTHER = 'OTHER';

    /**
     * @var string
     * The notes about the escalation of the dispute to a claim.
     *
     * minLength: 1
     * maxLength: 2000
     */
    public $note;

    /**
     * @var string
     * The customer's reason for escalation.
     *
     * use one of constants defined in this class to set the value:
     * @see BUYER_ESCALATION_REASON_SHIPMENT_NOT_ARRIVED
     * @see BUYER_ESCALATION_REASON_FRAUDULENT_SELLER
     * @see BUYER_ESCALATION_REASON_FAILED_NEGOTIATION
     * @see BUYER_ESCALATION_REASON_INCONCLUSIVE_NEGOTIATION
     * @see BUYER_ESCALATION_REASON_REFUND_NOT_RECEIVED
     * @see BUYER_ESCALATION_REASON_REFUND_AMOUNT_IS_DIFFERENT
     * @see BUYER_ESCALATION_REASON_TRACKING_ID_INVALID
     * @see BUYER_ESCALATION_REASON_OTHER
     * minLength: 1
     * maxLength: 255
     */
    public $buyer_escalation_reason;

    /**
     * @var Money
     * The currency and amount for a financial transaction, such as a balance or payment due.
     */
    public $buyer_requested_amount;

    public function validate()
    {
        assert(!isset($this->note) || strlen($this->note) >= 1);
        assert(!isset($this->note) || strlen($this->note) <= 2000);
        assert(!isset($this->buyer_escalation_reason) || strlen($this->buyer_escalation_reason) >= 1);
        assert(!isset($this->buyer_escalation_reason) || strlen($this->buyer_escalation_reason) <= 255);
        assert(isset($this->buyer_requested_amount));
    }
}

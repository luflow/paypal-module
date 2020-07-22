<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The customer and merchant payment preferences.
 *
 * generated from: MerchantsCommonComponentsSpecification-v1-schema-payment_method.json
 */
class PaymentMethod implements JsonSerializable
{
    use BaseModel;

    /** PayPal Credit. */
    const PAYER_SELECTED_PAYPAL_CREDIT = 'PAYPAL_CREDIT';

    /** PayPal. */
    const PAYER_SELECTED_PAYPAL = 'PAYPAL';

    /** Accepts any type of payment from the customer. */
    const PAYEE_PREFERRED_UNRESTRICTED = 'UNRESTRICTED';

    /** Accepts only immediate payment from the customer. For example, credit card, PayPal balance, or instant ACH. Ensures that at the time of capture, the payment does not have the `pending` status. */
    const PAYEE_PREFERRED_IMMEDIATE_PAYMENT_REQUIRED = 'IMMEDIATE_PAYMENT_REQUIRED';

    /** The API caller (merchant/partner) accepts authorization and payment information from a consumer over the telephone. */
    const STANDARD_ENTRY_CLASS_CODE_TEL = 'TEL';

    /** The API caller (merchant/partner) accepts Debit transactions from a consumer on their website. */
    const STANDARD_ENTRY_CLASS_CODE_WEB = 'WEB';

    /** Cash concentration and disbursement for corporate debit transaction. Used to disburse or consolidate funds. Entries are usually Optional high-dollar, low-volume, and time-critical. (e.g. intra-company transfers or invoice payments to suppliers). */
    const STANDARD_ENTRY_CLASS_CODE_CCD = 'CCD';

    /** Prearranged payment and deposit entries. Used for debit payments authorized by a consumer account holder, and usually initiated by a company. These are usually recurring debits (such as insurance premiums). */
    const STANDARD_ENTRY_CLASS_CODE_PPD = 'PPD';

    /**
     * @var string
     * The customer-selected payment method on the merchant site.
     *
     * use one of constants defined in this class to set the value:
     * @see PAYER_SELECTED_PAYPAL_CREDIT
     * @see PAYER_SELECTED_PAYPAL
     * minLength: 1
     */
    public $payer_selected;

    /**
     * @var string
     * The merchant-preferred payment methods.
     *
     * use one of constants defined in this class to set the value:
     * @see PAYEE_PREFERRED_UNRESTRICTED
     * @see PAYEE_PREFERRED_IMMEDIATE_PAYMENT_REQUIRED
     * minLength: 1
     * maxLength: 255
     */
    public $payee_preferred;

    /**
     * @var string
     * NACHA (the regulatory body governing the ACH network) requires that API callers (merchants, partners) obtain
     * the consumer’s explicit authorization before initiating a transaction. To stay compliant, you’ll need to
     * make sure that you retain a compliant authorization for each transaction that you originate to the ACH Network
     * using this API. ACH transactions are categorized (using SEC codes) by how you capture authorization from the
     * Receiver (the person whose bank account is being debited or credited). PayPal supports the following SEC
     * codes.
     *
     * use one of constants defined in this class to set the value:
     * @see STANDARD_ENTRY_CLASS_CODE_TEL
     * @see STANDARD_ENTRY_CLASS_CODE_WEB
     * @see STANDARD_ENTRY_CLASS_CODE_CCD
     * @see STANDARD_ENTRY_CLASS_CODE_PPD
     * minLength: 3
     * maxLength: 255
     */
    public $standard_entry_class_code;

    public function validate()
    {
        assert(!isset($this->payer_selected) || strlen($this->payer_selected) >= 1);
        assert(!isset($this->payee_preferred) || strlen($this->payee_preferred) >= 1);
        assert(!isset($this->payee_preferred) || strlen($this->payee_preferred) <= 255);
        assert(!isset($this->standard_entry_class_code) || strlen($this->standard_entry_class_code) >= 3);
        assert(!isset($this->standard_entry_class_code) || strlen($this->standard_entry_class_code) <= 255);
    }
}

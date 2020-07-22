<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;

/**
 * The product information.
 *
 * generated from: response-product_details.json
 */
class ProductDetails implements JsonSerializable
{
    use BaseModel;

    /** The product was received. */
    const PRODUCT_RECEIVED_YES = 'YES';

    /** The product was not received. */
    const PRODUCT_RECEIVED_NO = 'NO';

    /** The product was returned. */
    const PRODUCT_RECEIVED_RETURNED = 'RETURNED';

    /**
     * @var string
     * The product description.
     *
     * minLength: 1
     * maxLength: 2000
     */
    public $description;

    /**
     * @var string
     * Indicates whether the product was, or was not, received or returned.
     *
     * use one of constants defined in this class to set the value:
     * @see PRODUCT_RECEIVED_YES
     * @see PRODUCT_RECEIVED_NO
     * @see PRODUCT_RECEIVED_RETURNED
     * minLength: 1
     * maxLength: 255
     */
    public $product_received;

    /**
     * @var string
     * The date and time, in [Internet date and time format](https://tools.ietf.org/html/rfc3339#section-5.6).
     * Seconds are required while fractional seconds are optional.<blockquote><strong>Note:</strong> The regular
     * expression provides guidance but does not reject all invalid dates.</blockquote>
     *
     * minLength: 20
     * maxLength: 64
     */
    public $product_received_time;

    /**
     * @var array<string>
     * An array of sub-reasons for the product issue.
     */
    public $sub_reasons;

    /**
     * @var string
     * The URL where the customer purchased the product.
     *
     * minLength: 1
     * maxLength: 2000
     */
    public $purchase_url;

    /**
     * @var ReturnDetails
     * The return details for the product.
     */
    public $return_details;

    public function validate()
    {
        assert(!isset($this->description) || strlen($this->description) >= 1);
        assert(!isset($this->description) || strlen($this->description) <= 2000);
        assert(!isset($this->product_received) || strlen($this->product_received) >= 1);
        assert(!isset($this->product_received) || strlen($this->product_received) <= 255);
        assert(!isset($this->product_received_time) || strlen($this->product_received_time) >= 20);
        assert(!isset($this->product_received_time) || strlen($this->product_received_time) <= 64);
        assert(!isset($this->purchase_url) || strlen($this->purchase_url) >= 1);
        assert(!isset($this->purchase_url) || strlen($this->purchase_url) <= 2000);
    }
}

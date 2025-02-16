<?php

namespace WPSmsPro\Vendor\MessageBird\Objects\Conversation;

use WPSmsPro\Vendor\MessageBird\Objects\Base;
/**
 * Represents a counterparty with who messages can be exchanged.
 */
class Contact extends Base
{
    /**
     * A unique ID generated by the MessageBird platform that identifies the
     * contact.
     * 
     * @var string
     */
    public $id;
    /**
     * The URL of this contact object.
     *
     * @var string
     */
    public $href;
    /**
     * The MSISDN/phone number of this contact.
     * 
     * @var string
     */
    public $msisdn;
    /**
     * @var string
     */
    public $firstName;
    /**
     * @var string
     */
    public $lastName;
    /**
     * An associative array containing additional details about this contact.
     * 
     * @var array
     */
    public $customDetails;
    /**
     * The date and time when this contact was first created in RFC3339
     * format.
     *
     * @var string
     */
    public $createdDatetime;
    /**
     * The date and time when this contact was most recently updated in
     * RFC3339 format.
     * 
     * @var string
     */
    public $updatedDatetime;
    /**
     * @param $object
     *
     * @return self
     */
    public function loadFromArray($object)
    {
        parent::loadFromArray($object);
        if (!empty($this->customDetails)) {
            $this->customDetails = (array) $this->customDetails;
        }
        return $this;
    }
}

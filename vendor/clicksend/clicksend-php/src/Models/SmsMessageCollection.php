<?php

/*
 * ClickSend
 *
 * This file was automatically generated for ClickSend by APIMATIC v2.0 ( https://apimatic.io ).
 */
namespace WPSmsPro\Vendor\ClickSendLib\Models;

use JsonSerializable;
/**
 * @todo Write general description for this model
 */
class SmsMessageCollection implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @required
     * @var SmsMessage[] $messages public property
     */
    public $messages;
    /**
     * Constructor to set initial or default values of member properties
     * @param array $messages Initialization value for $this->messages
     */
    public function __construct()
    {
        if (1 == \func_num_args()) {
            $this->messages = \func_get_arg(0);
        }
    }
    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['messages'] = $this->messages;
        return $json;
    }
}

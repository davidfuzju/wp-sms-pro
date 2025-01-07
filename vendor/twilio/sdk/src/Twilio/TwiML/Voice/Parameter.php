<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\TwiML\Voice;

use WPSmsPro\Vendor\Twilio\TwiML\TwiML;
class Parameter extends TwiML
{
    /**
     * Parameter constructor.
     *
     * @param array $attributes Optional attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct('Parameter', null, $attributes);
    }
    /**
     * Add Name attribute.
     *
     * @param string $name The name of the custom parameter
     */
    public function setName($name) : self
    {
        return $this->setAttribute('name', $name);
    }
    /**
     * Add Value attribute.
     *
     * @param string $value The value of the custom parameter
     */
    public function setValue($value) : self
    {
        return $this->setAttribute('value', $value);
    }
}

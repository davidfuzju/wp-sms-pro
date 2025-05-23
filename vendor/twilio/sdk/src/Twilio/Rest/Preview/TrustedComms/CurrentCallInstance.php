<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\TrustedComms;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $bgColor
 * @property string $caller
 * @property \DateTime $createdAt
 * @property string $fontColor
 * @property string $from
 * @property string $logo
 * @property string $manager
 * @property string $reason
 * @property string $shieldImg
 * @property string $sid
 * @property string $status
 * @property string $to
 * @property string $url
 * @property string $useCase
 */
class CurrentCallInstance extends InstanceResource
{
    /**
     * Initialize the CurrentCallInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     */
    public function __construct(Version $version, array $payload)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['bgColor' => Values::array_get($payload, 'bg_color'), 'caller' => Values::array_get($payload, 'caller'), 'createdAt' => Deserialize::dateTime(Values::array_get($payload, 'created_at')), 'fontColor' => Values::array_get($payload, 'font_color'), 'from' => Values::array_get($payload, 'from'), 'logo' => Values::array_get($payload, 'logo'), 'manager' => Values::array_get($payload, 'manager'), 'reason' => Values::array_get($payload, 'reason'), 'shieldImg' => Values::array_get($payload, 'shield_img'), 'sid' => Values::array_get($payload, 'sid'), 'status' => Values::array_get($payload, 'status'), 'to' => Values::array_get($payload, 'to'), 'url' => Values::array_get($payload, 'url'), 'useCase' => Values::array_get($payload, 'use_case')];
        $this->solution = [];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return CurrentCallContext Context for this CurrentCallInstance
     */
    protected function proxy() : CurrentCallContext
    {
        if (!$this->context) {
            $this->context = new CurrentCallContext($this->version);
        }
        return $this->context;
    }
    /**
     * Fetch the CurrentCallInstance
     *
     * @param array|Options $options Optional Arguments
     * @return CurrentCallInstance Fetched CurrentCallInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(array $options = []) : CurrentCallInstance
    {
        return $this->proxy()->fetch($options);
    }
    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown property: ' . $name);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "{$key}={$value}";
        }
        return '[Twilio.Preview.TrustedComms.CurrentCallInstance ' . \implode(' ', $context) . ']';
    }
}

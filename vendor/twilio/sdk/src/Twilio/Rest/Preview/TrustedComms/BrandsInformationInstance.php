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
 * @property \DateTime $updateTime
 * @property string $fileLink
 * @property string $fileLinkTtlInSeconds
 * @property string $url
 */
class BrandsInformationInstance extends InstanceResource
{
    /**
     * Initialize the BrandsInformationInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     */
    public function __construct(Version $version, array $payload)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['updateTime' => Deserialize::dateTime(Values::array_get($payload, 'update_time')), 'fileLink' => Values::array_get($payload, 'file_link'), 'fileLinkTtlInSeconds' => Values::array_get($payload, 'file_link_ttl_in_seconds'), 'url' => Values::array_get($payload, 'url')];
        $this->solution = [];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return BrandsInformationContext Context for this BrandsInformationInstance
     */
    protected function proxy() : BrandsInformationContext
    {
        if (!$this->context) {
            $this->context = new BrandsInformationContext($this->version);
        }
        return $this->context;
    }
    /**
     * Fetch the BrandsInformationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return BrandsInformationInstance Fetched BrandsInformationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(array $options = []) : BrandsInformationInstance
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
        return '[Twilio.Preview.TrustedComms.BrandsInformationInstance ' . \implode(' ', $context) . ']';
    }
}

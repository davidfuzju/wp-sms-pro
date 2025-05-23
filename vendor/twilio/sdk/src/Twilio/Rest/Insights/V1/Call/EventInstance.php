<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Insights\V1\Call;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $timestamp
 * @property string $callSid
 * @property string $accountSid
 * @property string $edge
 * @property string $group
 * @property string $level
 * @property string $name
 * @property array $carrierEdge
 * @property array $sipEdge
 * @property array $sdkEdge
 * @property array $clientEdge
 */
class EventInstance extends InstanceResource
{
    /**
     * Initialize the EventInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $callSid The call_sid
     */
    public function __construct(Version $version, array $payload, string $callSid)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['timestamp' => Values::array_get($payload, 'timestamp'), 'callSid' => Values::array_get($payload, 'call_sid'), 'accountSid' => Values::array_get($payload, 'account_sid'), 'edge' => Values::array_get($payload, 'edge'), 'group' => Values::array_get($payload, 'group'), 'level' => Values::array_get($payload, 'level'), 'name' => Values::array_get($payload, 'name'), 'carrierEdge' => Values::array_get($payload, 'carrier_edge'), 'sipEdge' => Values::array_get($payload, 'sip_edge'), 'sdkEdge' => Values::array_get($payload, 'sdk_edge'), 'clientEdge' => Values::array_get($payload, 'client_edge')];
        $this->solution = ['callSid' => $callSid];
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
        return '[Twilio.Insights.V1.EventInstance]';
    }
}

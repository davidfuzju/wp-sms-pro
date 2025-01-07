<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Wireless\Sim;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $simSid
 * @property string $simUniqueName
 * @property string $accountSid
 * @property array $period
 * @property array $commandsUsage
 * @property array $commandsCosts
 * @property array $dataUsage
 * @property array $dataCosts
 * @property string $url
 */
class UsageInstance extends InstanceResource
{
    /**
     * Initialize the UsageInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $simSid The sim_sid
     */
    public function __construct(Version $version, array $payload, string $simSid)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['simSid' => Values::array_get($payload, 'sim_sid'), 'simUniqueName' => Values::array_get($payload, 'sim_unique_name'), 'accountSid' => Values::array_get($payload, 'account_sid'), 'period' => Values::array_get($payload, 'period'), 'commandsUsage' => Values::array_get($payload, 'commands_usage'), 'commandsCosts' => Values::array_get($payload, 'commands_costs'), 'dataUsage' => Values::array_get($payload, 'data_usage'), 'dataCosts' => Values::array_get($payload, 'data_costs'), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['simSid' => $simSid];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return UsageContext Context for this UsageInstance
     */
    protected function proxy() : UsageContext
    {
        if (!$this->context) {
            $this->context = new UsageContext($this->version, $this->solution['simSid']);
        }
        return $this->context;
    }
    /**
     * Fetch the UsageInstance
     *
     * @param array|Options $options Optional Arguments
     * @return UsageInstance Fetched UsageInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(array $options = []) : UsageInstance
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
        return '[Twilio.Preview.Wireless.UsageInstance ' . \implode(' ', $context) . ']';
    }
}

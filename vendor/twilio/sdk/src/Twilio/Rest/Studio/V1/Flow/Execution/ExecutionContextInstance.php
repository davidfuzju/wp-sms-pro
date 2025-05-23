<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Studio\V1\Flow\Execution;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property array $context
 * @property string $flowSid
 * @property string $executionSid
 * @property string $url
 */
class ExecutionContextInstance extends InstanceResource
{
    /**
     * Initialize the ExecutionContextInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $flowSid The SID of the Flow
     * @param string $executionSid The SID of the Execution
     */
    public function __construct(Version $version, array $payload, string $flowSid, string $executionSid)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'context' => Values::array_get($payload, 'context'), 'flowSid' => Values::array_get($payload, 'flow_sid'), 'executionSid' => Values::array_get($payload, 'execution_sid'), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['flowSid' => $flowSid, 'executionSid' => $executionSid];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ExecutionContextContext Context for this ExecutionContextInstance
     */
    protected function proxy() : ExecutionContextContext
    {
        if (!$this->context) {
            $this->context = new ExecutionContextContext($this->version, $this->solution['flowSid'], $this->solution['executionSid']);
        }
        return $this->context;
    }
    /**
     * Fetch the ExecutionContextInstance
     *
     * @return ExecutionContextInstance Fetched ExecutionContextInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : ExecutionContextInstance
    {
        return $this->proxy()->fetch();
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
        return '[Twilio.Studio.V1.ExecutionContextInstance ' . \implode(' ', $context) . ']';
    }
}

<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Studio\V1\Flow;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Rest\Studio\V1\Flow\Execution\ExecutionContextList;
use WPSmsPro\Vendor\Twilio\Rest\Studio\V1\Flow\Execution\ExecutionStepList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $sid
 * @property string $accountSid
 * @property string $flowSid
 * @property string $contactSid
 * @property string $contactChannelAddress
 * @property array $context
 * @property string $status
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $url
 * @property array $links
 */
class ExecutionInstance extends InstanceResource
{
    protected $_steps;
    protected $_executionContext;
    /**
     * Initialize the ExecutionInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $flowSid The SID of the Flow
     * @param string $sid The SID of the Execution resource to fetch
     */
    public function __construct(Version $version, array $payload, string $flowSid, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['sid' => Values::array_get($payload, 'sid'), 'accountSid' => Values::array_get($payload, 'account_sid'), 'flowSid' => Values::array_get($payload, 'flow_sid'), 'contactSid' => Values::array_get($payload, 'contact_sid'), 'contactChannelAddress' => Values::array_get($payload, 'contact_channel_address'), 'context' => Values::array_get($payload, 'context'), 'status' => Values::array_get($payload, 'status'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'url' => Values::array_get($payload, 'url'), 'links' => Values::array_get($payload, 'links')];
        $this->solution = ['flowSid' => $flowSid, 'sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ExecutionContext Context for this ExecutionInstance
     */
    protected function proxy() : ExecutionContext
    {
        if (!$this->context) {
            $this->context = new ExecutionContext($this->version, $this->solution['flowSid'], $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the ExecutionInstance
     *
     * @return ExecutionInstance Fetched ExecutionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : ExecutionInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Delete the ExecutionInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->proxy()->delete();
    }
    /**
     * Update the ExecutionInstance
     *
     * @param string $status The status of the Execution
     * @return ExecutionInstance Updated ExecutionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(string $status) : ExecutionInstance
    {
        return $this->proxy()->update($status);
    }
    /**
     * Access the steps
     */
    protected function getSteps() : ExecutionStepList
    {
        return $this->proxy()->steps;
    }
    /**
     * Access the executionContext
     */
    protected function getExecutionContext() : ExecutionContextList
    {
        return $this->proxy()->executionContext;
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
        return '[Twilio.Studio.V1.ExecutionInstance ' . \implode(' ', $context) . ']';
    }
}

<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Studio\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Rest\Studio\V1\Flow\EngagementList;
use WPSmsPro\Vendor\Twilio\Rest\Studio\V1\Flow\ExecutionList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property EngagementList $engagements
 * @property ExecutionList $executions
 * @method \Twilio\Rest\Studio\V1\Flow\EngagementContext engagements(string $sid)
 * @method \Twilio\Rest\Studio\V1\Flow\ExecutionContext executions(string $sid)
 */
class FlowContext extends InstanceContext
{
    protected $_engagements;
    protected $_executions;
    /**
     * Initialize the FlowContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/Flows/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the FlowInstance
     *
     * @return FlowInstance Fetched FlowInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : FlowInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new FlowInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Delete the FlowInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Access the engagements
     */
    protected function getEngagements() : EngagementList
    {
        if (!$this->_engagements) {
            $this->_engagements = new EngagementList($this->version, $this->solution['sid']);
        }
        return $this->_engagements;
    }
    /**
     * Access the executions
     */
    protected function getExecutions() : ExecutionList
    {
        if (!$this->_executions) {
            $this->_executions = new ExecutionList($this->version, $this->solution['sid']);
        }
        return $this->_executions;
    }
    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name) : ListResource
    {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown subresource ' . $name);
    }
    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments) : InstanceContext
    {
        $property = $this->{$name};
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }
        throw new TwilioException('Resource does not have a context');
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
        return '[Twilio.Studio.V1.FlowContext ' . \implode(' ', $context) . ']';
    }
}

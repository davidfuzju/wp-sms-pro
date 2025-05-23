<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Events\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Rest\Events\V1\Sink\SinkTestList;
use WPSmsPro\Vendor\Twilio\Rest\Events\V1\Sink\SinkValidateList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property SinkTestList $sinkTest
 * @property SinkValidateList $sinkValidate
 */
class SinkContext extends InstanceContext
{
    protected $_sinkTest;
    protected $_sinkValidate;
    /**
     * Initialize the SinkContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid A string that uniquely identifies this Sink.
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/Sinks/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the SinkInstance
     *
     * @return SinkInstance Fetched SinkInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : SinkInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new SinkInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Delete the SinkInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Update the SinkInstance
     *
     * @param string $description Sink Description
     * @return SinkInstance Updated SinkInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(string $description) : SinkInstance
    {
        $data = Values::of(['Description' => $description]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new SinkInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Access the sinkTest
     */
    protected function getSinkTest() : SinkTestList
    {
        if (!$this->_sinkTest) {
            $this->_sinkTest = new SinkTestList($this->version, $this->solution['sid']);
        }
        return $this->_sinkTest;
    }
    /**
     * Access the sinkValidate
     */
    protected function getSinkValidate() : SinkValidateList
    {
        if (!$this->_sinkValidate) {
            $this->_sinkValidate = new SinkValidateList($this->version, $this->solution['sid']);
        }
        return $this->_sinkValidate;
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
        return '[Twilio.Events.V1.SinkContext ' . \implode(' ', $context) . ']';
    }
}

<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\Recording;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\Recording\AddOnResult\PayloadList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property PayloadList $payloads
 * @method \Twilio\Rest\Api\V2010\Account\Recording\AddOnResult\PayloadContext payloads(string $sid)
 */
class AddOnResultContext extends InstanceContext
{
    protected $_payloads;
    /**
     * Initialize the AddOnResultContext
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created the resource
     *                           to fetch
     * @param string $referenceSid The SID of the recording to which the result to
     *                             fetch belongs
     * @param string $sid The unique string that identifies the resource to fetch
     */
    public function __construct(Version $version, $accountSid, $referenceSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'referenceSid' => $referenceSid, 'sid' => $sid];
        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/Recordings/' . \rawurlencode($referenceSid) . '/AddOnResults/' . \rawurlencode($sid) . '.json';
    }
    /**
     * Fetch the AddOnResultInstance
     *
     * @return AddOnResultInstance Fetched AddOnResultInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : AddOnResultInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new AddOnResultInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['referenceSid'], $this->solution['sid']);
    }
    /**
     * Delete the AddOnResultInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Access the payloads
     */
    protected function getPayloads() : PayloadList
    {
        if (!$this->_payloads) {
            $this->_payloads = new PayloadList($this->version, $this->solution['accountSid'], $this->solution['referenceSid'], $this->solution['sid']);
        }
        return $this->_payloads;
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
        return '[Twilio.Api.V2010.AddOnResultContext ' . \implode(' ', $context) . ']';
    }
}

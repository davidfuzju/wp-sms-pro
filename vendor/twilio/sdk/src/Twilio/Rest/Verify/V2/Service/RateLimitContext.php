<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Verify\V2\Service;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Verify\V2\Service\RateLimit\BucketList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property BucketList $buckets
 * @method \Twilio\Rest\Verify\V2\Service\RateLimit\BucketContext buckets(string $sid)
 */
class RateLimitContext extends InstanceContext
{
    protected $_buckets;
    /**
     * Initialize the RateLimitContext
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The SID of the Service that the resource is
     *                           associated with
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $serviceSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid, 'sid' => $sid];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/RateLimits/' . \rawurlencode($sid) . '';
    }
    /**
     * Update the RateLimitInstance
     *
     * @param array|Options $options Optional Arguments
     * @return RateLimitInstance Updated RateLimitInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : RateLimitInstance
    {
        $options = new Values($options);
        $data = Values::of(['Description' => $options['description']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new RateLimitInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['sid']);
    }
    /**
     * Fetch the RateLimitInstance
     *
     * @return RateLimitInstance Fetched RateLimitInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : RateLimitInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new RateLimitInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['sid']);
    }
    /**
     * Delete the RateLimitInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Access the buckets
     */
    protected function getBuckets() : BucketList
    {
        if (!$this->_buckets) {
            $this->_buckets = new BucketList($this->version, $this->solution['serviceSid'], $this->solution['sid']);
        }
        return $this->_buckets;
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
        return '[Twilio.Verify.V2.RateLimitContext ' . \implode(' ', $context) . ']';
    }
}

<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Chat\V2\Service;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class BindingContext extends InstanceContext
{
    /**
     * Initialize the BindingContext
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The SID of the Service to fetch the resource from
     * @param string $sid The SID of the resource to fetch
     */
    public function __construct(Version $version, $serviceSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid, 'sid' => $sid];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/Bindings/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the BindingInstance
     *
     * @return BindingInstance Fetched BindingInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : BindingInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new BindingInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['sid']);
    }
    /**
     * Delete the BindingInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
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
        return '[Twilio.Chat.V2.BindingContext ' . \implode(' ', $context) . ']';
    }
}

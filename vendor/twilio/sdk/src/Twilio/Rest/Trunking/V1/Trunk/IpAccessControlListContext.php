<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Trunking\V1\Trunk;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class IpAccessControlListContext extends InstanceContext
{
    /**
     * Initialize the IpAccessControlListContext
     *
     * @param Version $version Version that contains the resource
     * @param string $trunkSid The SID of the Trunk from which to fetch the IP
     *                         Access Control List
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $trunkSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['trunkSid' => $trunkSid, 'sid' => $sid];
        $this->uri = '/Trunks/' . \rawurlencode($trunkSid) . '/IpAccessControlLists/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the IpAccessControlListInstance
     *
     * @return IpAccessControlListInstance Fetched IpAccessControlListInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : IpAccessControlListInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new IpAccessControlListInstance($this->version, $payload, $this->solution['trunkSid'], $this->solution['sid']);
    }
    /**
     * Delete the IpAccessControlListInstance
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
        return '[Twilio.Trunking.V1.IpAccessControlListContext ' . \implode(' ', $context) . ']';
    }
}

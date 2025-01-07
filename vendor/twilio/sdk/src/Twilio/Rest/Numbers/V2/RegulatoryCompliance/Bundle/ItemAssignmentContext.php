<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Numbers\V2\RegulatoryCompliance\Bundle;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class ItemAssignmentContext extends InstanceContext
{
    /**
     * Initialize the ItemAssignmentContext
     *
     * @param Version $version Version that contains the resource
     * @param string $bundleSid The unique string that identifies the resource.
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $bundleSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['bundleSid' => $bundleSid, 'sid' => $sid];
        $this->uri = '/RegulatoryCompliance/Bundles/' . \rawurlencode($bundleSid) . '/ItemAssignments/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the ItemAssignmentInstance
     *
     * @return ItemAssignmentInstance Fetched ItemAssignmentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : ItemAssignmentInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new ItemAssignmentInstance($this->version, $payload, $this->solution['bundleSid'], $this->solution['sid']);
    }
    /**
     * Delete the ItemAssignmentInstance
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
        return '[Twilio.Numbers.V2.ItemAssignmentContext ' . \implode(' ', $context) . ']';
    }
}

<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Marketplace\AvailableAddOn;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class AvailableAddOnExtensionContext extends InstanceContext
{
    /**
     * Initialize the AvailableAddOnExtensionContext
     *
     * @param Version $version Version that contains the resource
     * @param string $availableAddOnSid The SID of the AvailableAddOn resource with
     *                                  the extension to fetch
     * @param string $sid The SID of the AvailableAddOn Extension resource to fetch
     */
    public function __construct(Version $version, $availableAddOnSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['availableAddOnSid' => $availableAddOnSid, 'sid' => $sid];
        $this->uri = '/AvailableAddOns/' . \rawurlencode($availableAddOnSid) . '/Extensions/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the AvailableAddOnExtensionInstance
     *
     * @return AvailableAddOnExtensionInstance Fetched
     *                                         AvailableAddOnExtensionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : AvailableAddOnExtensionInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new AvailableAddOnExtensionInstance($this->version, $payload, $this->solution['availableAddOnSid'], $this->solution['sid']);
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
        return '[Twilio.Preview.Marketplace.AvailableAddOnExtensionContext ' . \implode(' ', $context) . ']';
    }
}

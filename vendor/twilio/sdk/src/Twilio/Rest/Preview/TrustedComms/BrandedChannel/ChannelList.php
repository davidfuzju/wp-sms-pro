<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\TrustedComms\BrandedChannel;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class ChannelList extends ListResource
{
    /**
     * Construct the ChannelList
     *
     * @param Version $version Version that contains the resource
     * @param string $brandedChannelSid Branded Channel Sid.
     */
    public function __construct(Version $version, string $brandedChannelSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['brandedChannelSid' => $brandedChannelSid];
        $this->uri = '/BrandedChannels/' . \rawurlencode($brandedChannelSid) . '/Channels';
    }
    /**
     * Create the ChannelInstance
     *
     * @param string $phoneNumberSid Phone Number Sid to be branded.
     * @return ChannelInstance Created ChannelInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $phoneNumberSid) : ChannelInstance
    {
        $data = Values::of(['PhoneNumberSid' => $phoneNumberSid]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new ChannelInstance($this->version, $payload, $this->solution['brandedChannelSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Preview.TrustedComms.ChannelList]';
    }
}

<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Chat\V1\Service\Channel;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class MemberContext extends InstanceContext
{
    /**
     * Initialize the MemberContext
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The SID of the Service to fetch the resource from
     * @param string $channelSid The unique ID of the channel the member belongs to
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $serviceSid, $channelSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid, 'channelSid' => $channelSid, 'sid' => $sid];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/Channels/' . \rawurlencode($channelSid) . '/Members/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the MemberInstance
     *
     * @return MemberInstance Fetched MemberInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : MemberInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new MemberInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['channelSid'], $this->solution['sid']);
    }
    /**
     * Delete the MemberInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Update the MemberInstance
     *
     * @param array|Options $options Optional Arguments
     * @return MemberInstance Updated MemberInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : MemberInstance
    {
        $options = new Values($options);
        $data = Values::of(['RoleSid' => $options['roleSid'], 'LastConsumedMessageIndex' => $options['lastConsumedMessageIndex']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new MemberInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['channelSid'], $this->solution['sid']);
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
        return '[Twilio.Chat.V1.MemberContext ' . \implode(' ', $context) . ']';
    }
}

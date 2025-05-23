<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Video\V1\Room\Participant;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class PublishedTrackContext extends InstanceContext
{
    /**
     * Initialize the PublishedTrackContext
     *
     * @param Version $version Version that contains the resource
     * @param string $roomSid The SID of the Room resource where the Track resource
     *                        to fetch is published
     * @param string $participantSid The SID of the Participant resource with the
     *                               published track to fetch
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function __construct(Version $version, $roomSid, $participantSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['roomSid' => $roomSid, 'participantSid' => $participantSid, 'sid' => $sid];
        $this->uri = '/Rooms/' . \rawurlencode($roomSid) . '/Participants/' . \rawurlencode($participantSid) . '/PublishedTracks/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the PublishedTrackInstance
     *
     * @return PublishedTrackInstance Fetched PublishedTrackInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : PublishedTrackInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new PublishedTrackInstance($this->version, $payload, $this->solution['roomSid'], $this->solution['participantSid'], $this->solution['sid']);
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
        return '[Twilio.Video.V1.PublishedTrackContext ' . \implode(' ', $context) . ']';
    }
}

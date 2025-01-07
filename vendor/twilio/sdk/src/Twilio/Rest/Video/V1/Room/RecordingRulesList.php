<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Video\V1\Room;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class RecordingRulesList extends ListResource
{
    /**
     * Construct the RecordingRulesList
     *
     * @param Version $version Version that contains the resource
     * @param string $roomSid The SID of the Room resource for the Recording Rules
     */
    public function __construct(Version $version, string $roomSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['roomSid' => $roomSid];
        $this->uri = '/Rooms/' . \rawurlencode($roomSid) . '/RecordingRules';
    }
    /**
     * Fetch the RecordingRulesInstance
     *
     * @return RecordingRulesInstance Fetched RecordingRulesInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : RecordingRulesInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new RecordingRulesInstance($this->version, $payload, $this->solution['roomSid']);
    }
    /**
     * Update the RecordingRulesInstance
     *
     * @param array|Options $options Optional Arguments
     * @return RecordingRulesInstance Updated RecordingRulesInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : RecordingRulesInstance
    {
        $options = new Values($options);
        $data = Values::of(['Rules' => Serialize::jsonObject($options['rules'])]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new RecordingRulesInstance($this->version, $payload, $this->solution['roomSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Video.V1.RecordingRulesList]';
    }
}

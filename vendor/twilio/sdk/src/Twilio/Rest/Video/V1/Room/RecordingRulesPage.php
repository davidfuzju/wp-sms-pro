<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Video\V1\Room;

use WPSmsPro\Vendor\Twilio\Http\Response;
use WPSmsPro\Vendor\Twilio\Page;
use WPSmsPro\Vendor\Twilio\Version;
class RecordingRulesPage extends Page
{
    /**
     * @param Version $version Version that contains the resource
     * @param Response $response Response from the API
     * @param array $solution The context solution
     */
    public function __construct(Version $version, Response $response, array $solution)
    {
        parent::__construct($version, $response);
        // Path Solution
        $this->solution = $solution;
    }
    /**
     * @param array $payload Payload response from the API
     * @return RecordingRulesInstance \Twilio\Rest\Video\V1\Room\RecordingRulesInstance
     */
    public function buildInstance(array $payload) : RecordingRulesInstance
    {
        return new RecordingRulesInstance($this->version, $payload, $this->solution['roomSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Video.V1.RecordingRulesPage]';
    }
}

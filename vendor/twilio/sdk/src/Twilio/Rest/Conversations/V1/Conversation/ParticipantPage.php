<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\Conversation;

use WPSmsPro\Vendor\Twilio\Http\Response;
use WPSmsPro\Vendor\Twilio\Page;
use WPSmsPro\Vendor\Twilio\Version;
class ParticipantPage extends Page
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
     * @return ParticipantInstance \Twilio\Rest\Conversations\V1\Conversation\ParticipantInstance
     */
    public function buildInstance(array $payload) : ParticipantInstance
    {
        return new ParticipantInstance($this->version, $payload, $this->solution['conversationSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Conversations.V1.ParticipantPage]';
    }
}

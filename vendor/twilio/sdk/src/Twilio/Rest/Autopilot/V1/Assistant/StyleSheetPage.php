<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Autopilot\V1\Assistant;

use WPSmsPro\Vendor\Twilio\Http\Response;
use WPSmsPro\Vendor\Twilio\Page;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class StyleSheetPage extends Page
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
     * @return StyleSheetInstance \Twilio\Rest\Autopilot\V1\Assistant\StyleSheetInstance
     */
    public function buildInstance(array $payload) : StyleSheetInstance
    {
        return new StyleSheetInstance($this->version, $payload, $this->solution['assistantSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Autopilot.V1.StyleSheetPage]';
    }
}

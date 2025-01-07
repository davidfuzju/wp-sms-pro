<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber\AssignedAddOn;

use WPSmsPro\Vendor\Twilio\Http\Response;
use WPSmsPro\Vendor\Twilio\Page;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
class AssignedAddOnExtensionPage extends Page
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
     * @return AssignedAddOnExtensionInstance \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber\AssignedAddOn\AssignedAddOnExtensionInstance
     */
    public function buildInstance(array $payload) : AssignedAddOnExtensionInstance
    {
        return new AssignedAddOnExtensionInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['resourceSid'], $this->solution['assignedAddOnSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Api.V2010.AssignedAddOnExtensionPage]';
    }
}

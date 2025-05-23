<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Verify\V2\Service\Entity\Challenge;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
class NotificationList extends ListResource
{
    /**
     * Construct the NotificationList
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid Service Sid.
     * @param string $identity Unique external identifier of the Entity
     * @param string $challengeSid Challenge Sid.
     */
    public function __construct(Version $version, string $serviceSid, string $identity, string $challengeSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid, 'identity' => $identity, 'challengeSid' => $challengeSid];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/Entities/' . \rawurlencode($identity) . '/Challenges/' . \rawurlencode($challengeSid) . '/Notifications';
    }
    /**
     * Create the NotificationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return NotificationInstance Created NotificationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []) : NotificationInstance
    {
        $options = new Values($options);
        $data = Values::of(['Ttl' => $options['ttl']]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new NotificationInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['identity'], $this->solution['challengeSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Verify.V2.NotificationList]';
    }
}

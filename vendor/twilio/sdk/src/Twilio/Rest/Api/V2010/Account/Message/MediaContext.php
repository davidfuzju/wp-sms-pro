<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\Message;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class MediaContext extends InstanceContext
{
    /**
     * Initialize the MediaContext
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created the
     *                           resource(s) to fetch
     * @param string $messageSid The SID of the Message resource that this Media
     *                           resource belongs to
     * @param string $sid The unique string that identifies this resource
     */
    public function __construct(Version $version, $accountSid, $messageSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'messageSid' => $messageSid, 'sid' => $sid];
        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/Messages/' . \rawurlencode($messageSid) . '/Media/' . \rawurlencode($sid) . '.json';
    }
    /**
     * Delete the MediaInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Fetch the MediaInstance
     *
     * @return MediaInstance Fetched MediaInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : MediaInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new MediaInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['messageSid'], $this->solution['sid']);
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
        return '[Twilio.Api.V2010.MediaContext ' . \implode(' ', $context) . ']';
    }
}

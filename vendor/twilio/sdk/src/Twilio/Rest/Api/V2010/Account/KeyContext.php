<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class KeyContext extends InstanceContext
{
    /**
     * Initialize the KeyContext
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created the resource
     *                           to fetch
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $accountSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'sid' => $sid];
        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/Keys/' . \rawurlencode($sid) . '.json';
    }
    /**
     * Fetch the KeyInstance
     *
     * @return KeyInstance Fetched KeyInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : KeyInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new KeyInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['sid']);
    }
    /**
     * Update the KeyInstance
     *
     * @param array|Options $options Optional Arguments
     * @return KeyInstance Updated KeyInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : KeyInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new KeyInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['sid']);
    }
    /**
     * Delete the KeyInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
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
        return '[Twilio.Api.V2010.KeyContext ' . \implode(' ', $context) . ']';
    }
}

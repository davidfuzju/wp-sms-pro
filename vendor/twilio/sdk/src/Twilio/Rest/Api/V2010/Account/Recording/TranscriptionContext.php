<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\Recording;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class TranscriptionContext extends InstanceContext
{
    /**
     * Initialize the TranscriptionContext
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created the resource
     *                           to fetch
     * @param string $recordingSid The SID of the recording that created the
     *                             transcriptions to fetch
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $accountSid, $recordingSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'recordingSid' => $recordingSid, 'sid' => $sid];
        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/Recordings/' . \rawurlencode($recordingSid) . '/Transcriptions/' . \rawurlencode($sid) . '.json';
    }
    /**
     * Fetch the TranscriptionInstance
     *
     * @return TranscriptionInstance Fetched TranscriptionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : TranscriptionInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new TranscriptionInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['recordingSid'], $this->solution['sid']);
    }
    /**
     * Delete the TranscriptionInstance
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
        return '[Twilio.Api.V2010.TranscriptionContext ' . \implode(' ', $context) . ']';
    }
}

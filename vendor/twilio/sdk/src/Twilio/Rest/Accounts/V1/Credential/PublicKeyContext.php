<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Accounts\V1\Credential;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class PublicKeyContext extends InstanceContext
{
    /**
     * Initialize the PublicKeyContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/Credentials/PublicKeys/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the PublicKeyInstance
     *
     * @return PublicKeyInstance Fetched PublicKeyInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : PublicKeyInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new PublicKeyInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Update the PublicKeyInstance
     *
     * @param array|Options $options Optional Arguments
     * @return PublicKeyInstance Updated PublicKeyInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : PublicKeyInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new PublicKeyInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Delete the PublicKeyInstance
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
        return '[Twilio.Accounts.V1.PublicKeyContext ' . \implode(' ', $context) . ']';
    }
}

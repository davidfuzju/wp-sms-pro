<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Accounts\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class SecondaryAuthTokenContext extends InstanceContext
{
    /**
     * Initialize the SecondaryAuthTokenContext
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = [];
        $this->uri = '/AuthTokens/Secondary';
    }
    /**
     * Create the SecondaryAuthTokenInstance
     *
     * @return SecondaryAuthTokenInstance Created SecondaryAuthTokenInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create() : SecondaryAuthTokenInstance
    {
        $payload = $this->version->create('POST', $this->uri);
        return new SecondaryAuthTokenInstance($this->version, $payload);
    }
    /**
     * Delete the SecondaryAuthTokenInstance
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
        return '[Twilio.Accounts.V1.SecondaryAuthTokenContext ' . \implode(' ', $context) . ']';
    }
}

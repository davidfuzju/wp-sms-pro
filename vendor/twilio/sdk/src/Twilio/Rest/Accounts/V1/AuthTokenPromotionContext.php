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
class AuthTokenPromotionContext extends InstanceContext
{
    /**
     * Initialize the AuthTokenPromotionContext
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = [];
        $this->uri = '/AuthTokens/Promote';
    }
    /**
     * Update the AuthTokenPromotionInstance
     *
     * @return AuthTokenPromotionInstance Updated AuthTokenPromotionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update() : AuthTokenPromotionInstance
    {
        $payload = $this->version->update('POST', $this->uri);
        return new AuthTokenPromotionInstance($this->version, $payload);
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
        return '[Twilio.Accounts.V1.AuthTokenPromotionContext ' . \implode(' ', $context) . ']';
    }
}

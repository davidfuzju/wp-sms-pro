<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Pricing\V1\Voice;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class CountryContext extends InstanceContext
{
    /**
     * Initialize the CountryContext
     *
     * @param Version $version Version that contains the resource
     * @param string $isoCountry The ISO country code
     */
    public function __construct(Version $version, $isoCountry)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['isoCountry' => $isoCountry];
        $this->uri = '/Voice/Countries/' . \rawurlencode($isoCountry) . '';
    }
    /**
     * Fetch the CountryInstance
     *
     * @return CountryInstance Fetched CountryInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : CountryInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new CountryInstance($this->version, $payload, $this->solution['isoCountry']);
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
        return '[Twilio.Pricing.V1.CountryContext ' . \implode(' ', $context) . ']';
    }
}

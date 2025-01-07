<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Pricing\V2\Voice;

use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Version;
class NumberList extends ListResource
{
    /**
     * Construct the NumberList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = [];
    }
    /**
     * Constructs a NumberContext
     *
     * @param string $destinationNumber The destination number for which to fetch
     *                                  pricing information
     */
    public function getContext(string $destinationNumber) : NumberContext
    {
        return new NumberContext($this->version, $destinationNumber);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Pricing.V2.NumberList]';
    }
}

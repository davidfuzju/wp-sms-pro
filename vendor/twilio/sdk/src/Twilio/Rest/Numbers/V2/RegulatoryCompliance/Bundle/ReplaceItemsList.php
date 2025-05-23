<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Numbers\V2\RegulatoryCompliance\Bundle;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
class ReplaceItemsList extends ListResource
{
    /**
     * Construct the ReplaceItemsList
     *
     * @param Version $version Version that contains the resource
     * @param string $bundleSid The unique string that identifies the resource.
     */
    public function __construct(Version $version, string $bundleSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['bundleSid' => $bundleSid];
        $this->uri = '/RegulatoryCompliance/Bundles/' . \rawurlencode($bundleSid) . '/ReplaceItems';
    }
    /**
     * Create the ReplaceItemsInstance
     *
     * @param string $fromBundleSid The source bundle sid to copy the item
     *                              assignments from
     * @return ReplaceItemsInstance Created ReplaceItemsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $fromBundleSid) : ReplaceItemsInstance
    {
        $data = Values::of(['FromBundleSid' => $fromBundleSid]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new ReplaceItemsInstance($this->version, $payload, $this->solution['bundleSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Numbers.V2.ReplaceItemsList]';
    }
}

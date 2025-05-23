<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Numbers\V2\RegulatoryCompliance;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class SupportingDocumentContext extends InstanceContext
{
    /**
     * Initialize the SupportingDocumentContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/RegulatoryCompliance/SupportingDocuments/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the SupportingDocumentInstance
     *
     * @return SupportingDocumentInstance Fetched SupportingDocumentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : SupportingDocumentInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new SupportingDocumentInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Update the SupportingDocumentInstance
     *
     * @param array|Options $options Optional Arguments
     * @return SupportingDocumentInstance Updated SupportingDocumentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : SupportingDocumentInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName'], 'Attributes' => Serialize::jsonObject($options['attributes'])]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new SupportingDocumentInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Delete the SupportingDocumentInstance
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
        return '[Twilio.Numbers.V2.SupportingDocumentContext ' . \implode(' ', $context) . ']';
    }
}

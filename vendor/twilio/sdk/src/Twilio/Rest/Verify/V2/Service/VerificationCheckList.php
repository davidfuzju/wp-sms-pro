<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Verify\V2\Service;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class VerificationCheckList extends ListResource
{
    /**
     * Construct the VerificationCheckList
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The SID of the Service that the resource is
     *                           associated with
     */
    public function __construct(Version $version, string $serviceSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/VerificationCheck';
    }
    /**
     * Create the VerificationCheckInstance
     *
     * @param string $code The verification string
     * @param array|Options $options Optional Arguments
     * @return VerificationCheckInstance Created VerificationCheckInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $code, array $options = []) : VerificationCheckInstance
    {
        $options = new Values($options);
        $data = Values::of(['Code' => $code, 'To' => $options['to'], 'VerificationSid' => $options['verificationSid'], 'Amount' => $options['amount'], 'Payee' => $options['payee']]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new VerificationCheckInstance($this->version, $payload, $this->solution['serviceSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Verify.V2.VerificationCheckList]';
    }
}

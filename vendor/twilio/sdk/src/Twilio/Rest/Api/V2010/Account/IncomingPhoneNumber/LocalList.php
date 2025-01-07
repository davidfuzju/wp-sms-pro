<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Stream;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class LocalList extends ListResource
{
    /**
     * Construct the LocalList
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created the resource
     */
    public function __construct(Version $version, string $accountSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['accountSid' => $accountSid];
        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/IncomingPhoneNumbers/Local.json';
    }
    /**
     * Streams LocalInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return Stream stream of results
     */
    public function stream(array $options = [], int $limit = null, $pageSize = null) : Stream
    {
        $limits = $this->version->readLimits($limit, $pageSize);
        $page = $this->page($options, $limits['pageSize']);
        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }
    /**
     * Reads LocalInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return LocalInstance[] Array of results
     */
    public function read(array $options = [], int $limit = null, $pageSize = null) : array
    {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), \false);
    }
    /**
     * Retrieve a single page of LocalInstance records from the API.
     * Request is executed immediately
     *
     * @param array|Options $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return LocalPage Page of LocalInstance
     */
    public function page(array $options = [], $pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE) : LocalPage
    {
        $options = new Values($options);
        $params = Values::of(['Beta' => Serialize::booleanToString($options['beta']), 'FriendlyName' => $options['friendlyName'], 'PhoneNumber' => $options['phoneNumber'], 'Origin' => $options['origin'], 'PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize]);
        $response = $this->version->page('GET', $this->uri, $params);
        return new LocalPage($this->version, $response, $this->solution);
    }
    /**
     * Retrieve a specific page of LocalInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return LocalPage Page of LocalInstance
     */
    public function getPage(string $targetUrl) : LocalPage
    {
        $response = $this->version->getDomain()->getClient()->request('GET', $targetUrl);
        return new LocalPage($this->version, $response, $this->solution);
    }
    /**
     * Create the LocalInstance
     *
     * @param string $phoneNumber The phone number to purchase in E.164 format
     * @param array|Options $options Optional Arguments
     * @return LocalInstance Created LocalInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $phoneNumber, array $options = []) : LocalInstance
    {
        $options = new Values($options);
        $data = Values::of(['PhoneNumber' => $phoneNumber, 'ApiVersion' => $options['apiVersion'], 'FriendlyName' => $options['friendlyName'], 'SmsApplicationSid' => $options['smsApplicationSid'], 'SmsFallbackMethod' => $options['smsFallbackMethod'], 'SmsFallbackUrl' => $options['smsFallbackUrl'], 'SmsMethod' => $options['smsMethod'], 'SmsUrl' => $options['smsUrl'], 'StatusCallback' => $options['statusCallback'], 'StatusCallbackMethod' => $options['statusCallbackMethod'], 'VoiceApplicationSid' => $options['voiceApplicationSid'], 'VoiceCallerIdLookup' => Serialize::booleanToString($options['voiceCallerIdLookup']), 'VoiceFallbackMethod' => $options['voiceFallbackMethod'], 'VoiceFallbackUrl' => $options['voiceFallbackUrl'], 'VoiceMethod' => $options['voiceMethod'], 'VoiceUrl' => $options['voiceUrl'], 'IdentitySid' => $options['identitySid'], 'AddressSid' => $options['addressSid'], 'EmergencyStatus' => $options['emergencyStatus'], 'EmergencyAddressSid' => $options['emergencyAddressSid'], 'TrunkSid' => $options['trunkSid'], 'VoiceReceiveMode' => $options['voiceReceiveMode'], 'BundleSid' => $options['bundleSid']]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new LocalInstance($this->version, $payload, $this->solution['accountSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Api.V2010.LocalList]';
    }
}

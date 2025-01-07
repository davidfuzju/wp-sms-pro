<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\Sip\Domain;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Stream;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class CredentialListMappingList extends ListResource
{
    /**
     * Construct the CredentialListMappingList
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The unique id of the Account that is responsible
     *                           for this resource.
     * @param string $domainSid The unique string that identifies the SipDomain
     *                          resource.
     */
    public function __construct(Version $version, string $accountSid, string $domainSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'domainSid' => $domainSid];
        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/SIP/Domains/' . \rawurlencode($domainSid) . '/CredentialListMappings.json';
    }
    /**
     * Create the CredentialListMappingInstance
     *
     * @param string $credentialListSid A string that identifies the CredentialList
     *                                  resource to map to the SIP domain
     * @return CredentialListMappingInstance Created CredentialListMappingInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $credentialListSid) : CredentialListMappingInstance
    {
        $data = Values::of(['CredentialListSid' => $credentialListSid]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new CredentialListMappingInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['domainSid']);
    }
    /**
     * Streams CredentialListMappingInstance records from the API as a generator
     * stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
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
    public function stream(int $limit = null, $pageSize = null) : Stream
    {
        $limits = $this->version->readLimits($limit, $pageSize);
        $page = $this->page($limits['pageSize']);
        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }
    /**
     * Reads CredentialListMappingInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return CredentialListMappingInstance[] Array of results
     */
    public function read(int $limit = null, $pageSize = null) : array
    {
        return \iterator_to_array($this->stream($limit, $pageSize), \false);
    }
    /**
     * Retrieve a single page of CredentialListMappingInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return CredentialListMappingPage Page of CredentialListMappingInstance
     */
    public function page($pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE) : CredentialListMappingPage
    {
        $params = Values::of(['PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize]);
        $response = $this->version->page('GET', $this->uri, $params);
        return new CredentialListMappingPage($this->version, $response, $this->solution);
    }
    /**
     * Retrieve a specific page of CredentialListMappingInstance records from the
     * API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return CredentialListMappingPage Page of CredentialListMappingInstance
     */
    public function getPage(string $targetUrl) : CredentialListMappingPage
    {
        $response = $this->version->getDomain()->getClient()->request('GET', $targetUrl);
        return new CredentialListMappingPage($this->version, $response, $this->solution);
    }
    /**
     * Constructs a CredentialListMappingContext
     *
     * @param string $sid A string that identifies the resource to fetch
     */
    public function getContext(string $sid) : CredentialListMappingContext
    {
        return new CredentialListMappingContext($this->version, $this->solution['accountSid'], $this->solution['domainSid'], $sid);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Api.V2010.CredentialListMappingList]';
    }
}

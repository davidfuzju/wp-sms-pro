<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Sync\Service;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Stream;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class DocumentList extends ListResource
{
    /**
     * Construct the DocumentList
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The service_sid
     */
    public function __construct(Version $version, string $serviceSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/Documents';
    }
    /**
     * Create the DocumentInstance
     *
     * @param array|Options $options Optional Arguments
     * @return DocumentInstance Created DocumentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []) : DocumentInstance
    {
        $options = new Values($options);
        $data = Values::of(['UniqueName' => $options['uniqueName'], 'Data' => Serialize::jsonObject($options['data'])]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new DocumentInstance($this->version, $payload, $this->solution['serviceSid']);
    }
    /**
     * Streams DocumentInstance records from the API as a generator stream.
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
     * Reads DocumentInstance records from the API as a list.
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
     * @return DocumentInstance[] Array of results
     */
    public function read(int $limit = null, $pageSize = null) : array
    {
        return \iterator_to_array($this->stream($limit, $pageSize), \false);
    }
    /**
     * Retrieve a single page of DocumentInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return DocumentPage Page of DocumentInstance
     */
    public function page($pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE) : DocumentPage
    {
        $params = Values::of(['PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize]);
        $response = $this->version->page('GET', $this->uri, $params);
        return new DocumentPage($this->version, $response, $this->solution);
    }
    /**
     * Retrieve a specific page of DocumentInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return DocumentPage Page of DocumentInstance
     */
    public function getPage(string $targetUrl) : DocumentPage
    {
        $response = $this->version->getDomain()->getClient()->request('GET', $targetUrl);
        return new DocumentPage($this->version, $response, $this->solution);
    }
    /**
     * Constructs a DocumentContext
     *
     * @param string $sid The sid
     */
    public function getContext(string $sid) : DocumentContext
    {
        return new DocumentContext($this->version, $this->solution['serviceSid'], $sid);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Preview.Sync.DocumentList]';
    }
}

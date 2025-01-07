<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Autopilot\V1\Assistant;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Stream;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class QueryList extends ListResource
{
    /**
     * Construct the QueryList
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The SID of the Assistant that is the parent of
     *                             the resource
     */
    public function __construct(Version $version, string $assistantSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['assistantSid' => $assistantSid];
        $this->uri = '/Assistants/' . \rawurlencode($assistantSid) . '/Queries';
    }
    /**
     * Streams QueryInstance records from the API as a generator stream.
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
     * Reads QueryInstance records from the API as a list.
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
     * @return QueryInstance[] Array of results
     */
    public function read(array $options = [], int $limit = null, $pageSize = null) : array
    {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), \false);
    }
    /**
     * Retrieve a single page of QueryInstance records from the API.
     * Request is executed immediately
     *
     * @param array|Options $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return QueryPage Page of QueryInstance
     */
    public function page(array $options = [], $pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE) : QueryPage
    {
        $options = new Values($options);
        $params = Values::of(['Language' => $options['language'], 'ModelBuild' => $options['modelBuild'], 'Status' => $options['status'], 'DialogueSid' => $options['dialogueSid'], 'PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize]);
        $response = $this->version->page('GET', $this->uri, $params);
        return new QueryPage($this->version, $response, $this->solution);
    }
    /**
     * Retrieve a specific page of QueryInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return QueryPage Page of QueryInstance
     */
    public function getPage(string $targetUrl) : QueryPage
    {
        $response = $this->version->getDomain()->getClient()->request('GET', $targetUrl);
        return new QueryPage($this->version, $response, $this->solution);
    }
    /**
     * Create the QueryInstance
     *
     * @param string $language The ISO language-country string that specifies the
     *                         language used for the new query
     * @param string $query The end-user's natural language input
     * @param array|Options $options Optional Arguments
     * @return QueryInstance Created QueryInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $language, string $query, array $options = []) : QueryInstance
    {
        $options = new Values($options);
        $data = Values::of(['Language' => $language, 'Query' => $query, 'Tasks' => $options['tasks'], 'ModelBuild' => $options['modelBuild']]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new QueryInstance($this->version, $payload, $this->solution['assistantSid']);
    }
    /**
     * Constructs a QueryContext
     *
     * @param string $sid The unique string that identifies the resource
     */
    public function getContext(string $sid) : QueryContext
    {
        return new QueryContext($this->version, $this->solution['assistantSid'], $sid);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Autopilot.V1.QueryList]';
    }
}

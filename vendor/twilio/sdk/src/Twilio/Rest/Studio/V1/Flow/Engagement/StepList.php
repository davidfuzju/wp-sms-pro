<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Studio\V1\Flow\Engagement;

use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Stream;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class StepList extends ListResource
{
    /**
     * Construct the StepList
     *
     * @param Version $version Version that contains the resource
     * @param string $flowSid The SID of the Flow
     * @param string $engagementSid The SID of the Engagement
     */
    public function __construct(Version $version, string $flowSid, string $engagementSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['flowSid' => $flowSid, 'engagementSid' => $engagementSid];
        $this->uri = '/Flows/' . \rawurlencode($flowSid) . '/Engagements/' . \rawurlencode($engagementSid) . '/Steps';
    }
    /**
     * Streams StepInstance records from the API as a generator stream.
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
     * Reads StepInstance records from the API as a list.
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
     * @return StepInstance[] Array of results
     */
    public function read(int $limit = null, $pageSize = null) : array
    {
        return \iterator_to_array($this->stream($limit, $pageSize), \false);
    }
    /**
     * Retrieve a single page of StepInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return StepPage Page of StepInstance
     */
    public function page($pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE) : StepPage
    {
        $params = Values::of(['PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize]);
        $response = $this->version->page('GET', $this->uri, $params);
        return new StepPage($this->version, $response, $this->solution);
    }
    /**
     * Retrieve a specific page of StepInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return StepPage Page of StepInstance
     */
    public function getPage(string $targetUrl) : StepPage
    {
        $response = $this->version->getDomain()->getClient()->request('GET', $targetUrl);
        return new StepPage($this->version, $response, $this->solution);
    }
    /**
     * Constructs a StepContext
     *
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function getContext(string $sid) : StepContext
    {
        return new StepContext($this->version, $this->solution['flowSid'], $this->solution['engagementSid'], $sid);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Studio.V1.StepList]';
    }
}

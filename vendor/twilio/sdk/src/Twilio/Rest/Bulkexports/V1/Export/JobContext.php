<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Bulkexports\V1\Export;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class JobContext extends InstanceContext
{
    /**
     * Initialize the JobContext
     *
     * @param Version $version Version that contains the resource
     * @param string $jobSid The unique string that that we created to identify the
     *                       Bulk Export job
     */
    public function __construct(Version $version, $jobSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['jobSid' => $jobSid];
        $this->uri = '/Exports/Jobs/' . \rawurlencode($jobSid) . '';
    }
    /**
     * Fetch the JobInstance
     *
     * @return JobInstance Fetched JobInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : JobInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new JobInstance($this->version, $payload, $this->solution['jobSid']);
    }
    /**
     * Delete the JobInstance
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
        return '[Twilio.Bulkexports.V1.JobContext ' . \implode(' ', $context) . ']';
    }
}

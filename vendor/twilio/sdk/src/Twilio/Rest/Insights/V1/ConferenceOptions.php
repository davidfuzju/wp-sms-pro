<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Insights\V1;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class ConferenceOptions
{
    /**
     * @param string $conferenceSid The SID of the conference.
     * @param string $friendlyName Custom label for the conference.
     * @param string $status Conference status.
     * @param string $createdAfter Conferences created after timestamp.
     * @param string $createdBefore Conferences created before timestamp.
     * @param string $mixerRegion Region where the conference was mixed.
     * @param string $tags Tags applied by Twilio for common issues.
     * @param string $subaccount Account SID for the subaccount.
     * @param string $detectedIssues Potential issues detected during the
     *                               conference.
     * @param string $endReason Conference end reason.
     * @return ReadConferenceOptions Options builder
     */
    public static function read(string $conferenceSid = Values::NONE, string $friendlyName = Values::NONE, string $status = Values::NONE, string $createdAfter = Values::NONE, string $createdBefore = Values::NONE, string $mixerRegion = Values::NONE, string $tags = Values::NONE, string $subaccount = Values::NONE, string $detectedIssues = Values::NONE, string $endReason = Values::NONE) : ReadConferenceOptions
    {
        return new ReadConferenceOptions($conferenceSid, $friendlyName, $status, $createdAfter, $createdBefore, $mixerRegion, $tags, $subaccount, $detectedIssues, $endReason);
    }
}
class ReadConferenceOptions extends Options
{
    /**
     * @param string $conferenceSid The SID of the conference.
     * @param string $friendlyName Custom label for the conference.
     * @param string $status Conference status.
     * @param string $createdAfter Conferences created after timestamp.
     * @param string $createdBefore Conferences created before timestamp.
     * @param string $mixerRegion Region where the conference was mixed.
     * @param string $tags Tags applied by Twilio for common issues.
     * @param string $subaccount Account SID for the subaccount.
     * @param string $detectedIssues Potential issues detected during the
     *                               conference.
     * @param string $endReason Conference end reason.
     */
    public function __construct(string $conferenceSid = Values::NONE, string $friendlyName = Values::NONE, string $status = Values::NONE, string $createdAfter = Values::NONE, string $createdBefore = Values::NONE, string $mixerRegion = Values::NONE, string $tags = Values::NONE, string $subaccount = Values::NONE, string $detectedIssues = Values::NONE, string $endReason = Values::NONE)
    {
        $this->options['conferenceSid'] = $conferenceSid;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['status'] = $status;
        $this->options['createdAfter'] = $createdAfter;
        $this->options['createdBefore'] = $createdBefore;
        $this->options['mixerRegion'] = $mixerRegion;
        $this->options['tags'] = $tags;
        $this->options['subaccount'] = $subaccount;
        $this->options['detectedIssues'] = $detectedIssues;
        $this->options['endReason'] = $endReason;
    }
    /**
     * The SID of the conference.
     *
     * @param string $conferenceSid The SID of the conference.
     * @return $this Fluent Builder
     */
    public function setConferenceSid(string $conferenceSid) : self
    {
        $this->options['conferenceSid'] = $conferenceSid;
        return $this;
    }
    /**
     * Custom label for the conference resource, up to 64 characters.
     *
     * @param string $friendlyName Custom label for the conference.
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * Conference status.
     *
     * @param string $status Conference status.
     * @return $this Fluent Builder
     */
    public function setStatus(string $status) : self
    {
        $this->options['status'] = $status;
        return $this;
    }
    /**
     * Conferences created after the provided timestamp specified in ISO 8601 format
     *
     * @param string $createdAfter Conferences created after timestamp.
     * @return $this Fluent Builder
     */
    public function setCreatedAfter(string $createdAfter) : self
    {
        $this->options['createdAfter'] = $createdAfter;
        return $this;
    }
    /**
     * Conferences created before the provided timestamp specified in ISO 8601 format.
     *
     * @param string $createdBefore Conferences created before timestamp.
     * @return $this Fluent Builder
     */
    public function setCreatedBefore(string $createdBefore) : self
    {
        $this->options['createdBefore'] = $createdBefore;
        return $this;
    }
    /**
     * Twilio region where the conference media was mixed.
     *
     * @param string $mixerRegion Region where the conference was mixed.
     * @return $this Fluent Builder
     */
    public function setMixerRegion(string $mixerRegion) : self
    {
        $this->options['mixerRegion'] = $mixerRegion;
        return $this;
    }
    /**
     * Tags applied by Twilio for common potential configuration, quality, or performance issues.
     *
     * @param string $tags Tags applied by Twilio for common issues.
     * @return $this Fluent Builder
     */
    public function setTags(string $tags) : self
    {
        $this->options['tags'] = $tags;
        return $this;
    }
    /**
     * Account SID for the subaccount whose resources you wish to retrieve.
     *
     * @param string $subaccount Account SID for the subaccount.
     * @return $this Fluent Builder
     */
    public function setSubaccount(string $subaccount) : self
    {
        $this->options['subaccount'] = $subaccount;
        return $this;
    }
    /**
     * Potential configuration, behavior, or performance issues detected during the conference.
     *
     * @param string $detectedIssues Potential issues detected during the
     *                               conference.
     * @return $this Fluent Builder
     */
    public function setDetectedIssues(string $detectedIssues) : self
    {
        $this->options['detectedIssues'] = $detectedIssues;
        return $this;
    }
    /**
     * Conference end reason; e.g. last participant left, modified by API, etc.
     *
     * @param string $endReason Conference end reason.
     * @return $this Fluent Builder
     */
    public function setEndReason(string $endReason) : self
    {
        $this->options['endReason'] = $endReason;
        return $this;
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Insights.V1.ReadConferenceOptions ' . $options . ']';
    }
}

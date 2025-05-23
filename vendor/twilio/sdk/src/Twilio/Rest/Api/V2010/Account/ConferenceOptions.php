<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class ConferenceOptions
{
    /**
     * @param string $dateCreatedBefore The `YYYY-MM-DD` value of the resources to
     *                                  read
     * @param string $dateCreated The `YYYY-MM-DD` value of the resources to read
     * @param string $dateCreatedAfter The `YYYY-MM-DD` value of the resources to
     *                                 read
     * @param string $dateUpdatedBefore The `YYYY-MM-DD` value of the resources to
     *                                  read
     * @param string $dateUpdated The `YYYY-MM-DD` value of the resources to read
     * @param string $dateUpdatedAfter The `YYYY-MM-DD` value of the resources to
     *                                 read
     * @param string $friendlyName The string that identifies the Conference
     *                             resources to read
     * @param string $status The status of the resources to read
     * @return ReadConferenceOptions Options builder
     */
    public static function read(string $dateCreatedBefore = Values::NONE, string $dateCreated = Values::NONE, string $dateCreatedAfter = Values::NONE, string $dateUpdatedBefore = Values::NONE, string $dateUpdated = Values::NONE, string $dateUpdatedAfter = Values::NONE, string $friendlyName = Values::NONE, string $status = Values::NONE) : ReadConferenceOptions
    {
        return new ReadConferenceOptions($dateCreatedBefore, $dateCreated, $dateCreatedAfter, $dateUpdatedBefore, $dateUpdated, $dateUpdatedAfter, $friendlyName, $status);
    }
    /**
     * @param string $status The new status of the resource
     * @param string $announceUrl The URL we should call to announce something into
     *                            the conference
     * @param string $announceMethod he HTTP method used to call announce_url
     * @return UpdateConferenceOptions Options builder
     */
    public static function update(string $status = Values::NONE, string $announceUrl = Values::NONE, string $announceMethod = Values::NONE) : UpdateConferenceOptions
    {
        return new UpdateConferenceOptions($status, $announceUrl, $announceMethod);
    }
}
class ReadConferenceOptions extends Options
{
    /**
     * @param string $dateCreatedBefore The `YYYY-MM-DD` value of the resources to
     *                                  read
     * @param string $dateCreated The `YYYY-MM-DD` value of the resources to read
     * @param string $dateCreatedAfter The `YYYY-MM-DD` value of the resources to
     *                                 read
     * @param string $dateUpdatedBefore The `YYYY-MM-DD` value of the resources to
     *                                  read
     * @param string $dateUpdated The `YYYY-MM-DD` value of the resources to read
     * @param string $dateUpdatedAfter The `YYYY-MM-DD` value of the resources to
     *                                 read
     * @param string $friendlyName The string that identifies the Conference
     *                             resources to read
     * @param string $status The status of the resources to read
     */
    public function __construct(string $dateCreatedBefore = Values::NONE, string $dateCreated = Values::NONE, string $dateCreatedAfter = Values::NONE, string $dateUpdatedBefore = Values::NONE, string $dateUpdated = Values::NONE, string $dateUpdatedAfter = Values::NONE, string $friendlyName = Values::NONE, string $status = Values::NONE)
    {
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        $this->options['dateUpdatedBefore'] = $dateUpdatedBefore;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['dateUpdatedAfter'] = $dateUpdatedAfter;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['status'] = $status;
    }
    /**
     * The `date_created` value, specified as `YYYY-MM-DD`, of the resources to read. To read conferences that started on or before midnight on a date, use `<=YYYY-MM-DD`, and to specify  conferences that started on or after midnight on a date, use `>=YYYY-MM-DD`.
     *
     * @param string $dateCreatedBefore The `YYYY-MM-DD` value of the resources to
     *                                  read
     * @return $this Fluent Builder
     */
    public function setDateCreatedBefore(string $dateCreatedBefore) : self
    {
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
        return $this;
    }
    /**
     * The `date_created` value, specified as `YYYY-MM-DD`, of the resources to read. To read conferences that started on or before midnight on a date, use `<=YYYY-MM-DD`, and to specify  conferences that started on or after midnight on a date, use `>=YYYY-MM-DD`.
     *
     * @param string $dateCreated The `YYYY-MM-DD` value of the resources to read
     * @return $this Fluent Builder
     */
    public function setDateCreated(string $dateCreated) : self
    {
        $this->options['dateCreated'] = $dateCreated;
        return $this;
    }
    /**
     * The `date_created` value, specified as `YYYY-MM-DD`, of the resources to read. To read conferences that started on or before midnight on a date, use `<=YYYY-MM-DD`, and to specify  conferences that started on or after midnight on a date, use `>=YYYY-MM-DD`.
     *
     * @param string $dateCreatedAfter The `YYYY-MM-DD` value of the resources to
     *                                 read
     * @return $this Fluent Builder
     */
    public function setDateCreatedAfter(string $dateCreatedAfter) : self
    {
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        return $this;
    }
    /**
     * The `date_updated` value, specified as `YYYY-MM-DD`, of the resources to read. To read conferences that were last updated on or before midnight on a date, use `<=YYYY-MM-DD`, and to specify conferences that were last updated on or after midnight on a given date, use  `>=YYYY-MM-DD`.
     *
     * @param string $dateUpdatedBefore The `YYYY-MM-DD` value of the resources to
     *                                  read
     * @return $this Fluent Builder
     */
    public function setDateUpdatedBefore(string $dateUpdatedBefore) : self
    {
        $this->options['dateUpdatedBefore'] = $dateUpdatedBefore;
        return $this;
    }
    /**
     * The `date_updated` value, specified as `YYYY-MM-DD`, of the resources to read. To read conferences that were last updated on or before midnight on a date, use `<=YYYY-MM-DD`, and to specify conferences that were last updated on or after midnight on a given date, use  `>=YYYY-MM-DD`.
     *
     * @param string $dateUpdated The `YYYY-MM-DD` value of the resources to read
     * @return $this Fluent Builder
     */
    public function setDateUpdated(string $dateUpdated) : self
    {
        $this->options['dateUpdated'] = $dateUpdated;
        return $this;
    }
    /**
     * The `date_updated` value, specified as `YYYY-MM-DD`, of the resources to read. To read conferences that were last updated on or before midnight on a date, use `<=YYYY-MM-DD`, and to specify conferences that were last updated on or after midnight on a given date, use  `>=YYYY-MM-DD`.
     *
     * @param string $dateUpdatedAfter The `YYYY-MM-DD` value of the resources to
     *                                 read
     * @return $this Fluent Builder
     */
    public function setDateUpdatedAfter(string $dateUpdatedAfter) : self
    {
        $this->options['dateUpdatedAfter'] = $dateUpdatedAfter;
        return $this;
    }
    /**
     * The string that identifies the Conference resources to read.
     *
     * @param string $friendlyName The string that identifies the Conference
     *                             resources to read
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The status of the resources to read. Can be: `init`, `in-progress`, or `completed`.
     *
     * @param string $status The status of the resources to read
     * @return $this Fluent Builder
     */
    public function setStatus(string $status) : self
    {
        $this->options['status'] = $status;
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
        return '[Twilio.Api.V2010.ReadConferenceOptions ' . $options . ']';
    }
}
class UpdateConferenceOptions extends Options
{
    /**
     * @param string $status The new status of the resource
     * @param string $announceUrl The URL we should call to announce something into
     *                            the conference
     * @param string $announceMethod he HTTP method used to call announce_url
     */
    public function __construct(string $status = Values::NONE, string $announceUrl = Values::NONE, string $announceMethod = Values::NONE)
    {
        $this->options['status'] = $status;
        $this->options['announceUrl'] = $announceUrl;
        $this->options['announceMethod'] = $announceMethod;
    }
    /**
     * The new status of the resource. Can be:  Can be: `init`, `in-progress`, or `completed`. Specifying `completed` will end the conference and hang up all participants
     *
     * @param string $status The new status of the resource
     * @return $this Fluent Builder
     */
    public function setStatus(string $status) : self
    {
        $this->options['status'] = $status;
        return $this;
    }
    /**
     * The URL we should call to announce something into the conference. The URL can return an MP3, a WAV, or a TwiML document with `<Play>` or `<Say>`.
     *
     * @param string $announceUrl The URL we should call to announce something into
     *                            the conference
     * @return $this Fluent Builder
     */
    public function setAnnounceUrl(string $announceUrl) : self
    {
        $this->options['announceUrl'] = $announceUrl;
        return $this;
    }
    /**
     * The HTTP method used to call `announce_url`. Can be: `GET` or `POST` and the default is `POST`
     *
     * @param string $announceMethod he HTTP method used to call announce_url
     * @return $this Fluent Builder
     */
    public function setAnnounceMethod(string $announceMethod) : self
    {
        $this->options['announceMethod'] = $announceMethod;
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
        return '[Twilio.Api.V2010.UpdateConferenceOptions ' . $options . ']';
    }
}

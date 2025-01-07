<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Video\V1\Room;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class ParticipantOptions
{
    /**
     * @param string $status Read only the participants with this status
     * @param string $identity Read only the Participants with this user identity
     *                         value
     * @param \DateTime $dateCreatedAfter Read only Participants that started after
     *                                    this date in UTC ISO 8601 format
     * @param \DateTime $dateCreatedBefore Read only Participants that started
     *                                     before this date in ISO 8601 format
     * @return ReadParticipantOptions Options builder
     */
    public static function read(string $status = Values::NONE, string $identity = Values::NONE, \DateTime $dateCreatedAfter = Values::NONE, \DateTime $dateCreatedBefore = Values::NONE) : ReadParticipantOptions
    {
        return new ReadParticipantOptions($status, $identity, $dateCreatedAfter, $dateCreatedBefore);
    }
    /**
     * @param string $status The new status of the resource
     * @return UpdateParticipantOptions Options builder
     */
    public static function update(string $status = Values::NONE) : UpdateParticipantOptions
    {
        return new UpdateParticipantOptions($status);
    }
}
class ReadParticipantOptions extends Options
{
    /**
     * @param string $status Read only the participants with this status
     * @param string $identity Read only the Participants with this user identity
     *                         value
     * @param \DateTime $dateCreatedAfter Read only Participants that started after
     *                                    this date in UTC ISO 8601 format
     * @param \DateTime $dateCreatedBefore Read only Participants that started
     *                                     before this date in ISO 8601 format
     */
    public function __construct(string $status = Values::NONE, string $identity = Values::NONE, \DateTime $dateCreatedAfter = Values::NONE, \DateTime $dateCreatedBefore = Values::NONE)
    {
        $this->options['status'] = $status;
        $this->options['identity'] = $identity;
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
    }
    /**
     * Read only the participants with this status. Can be: `connected` or `disconnected`. For `in-progress` Rooms the default Status is `connected`, for `completed` Rooms only `disconnected` Participants are returned.
     *
     * @param string $status Read only the participants with this status
     * @return $this Fluent Builder
     */
    public function setStatus(string $status) : self
    {
        $this->options['status'] = $status;
        return $this;
    }
    /**
     * Read only the Participants with this [User](https://www.twilio.com/docs/chat/rest/user-resource) `identity` value.
     *
     * @param string $identity Read only the Participants with this user identity
     *                         value
     * @return $this Fluent Builder
     */
    public function setIdentity(string $identity) : self
    {
        $this->options['identity'] = $identity;
        return $this;
    }
    /**
     * Read only Participants that started after this date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601#UTC) format.
     *
     * @param \DateTime $dateCreatedAfter Read only Participants that started after
     *                                    this date in UTC ISO 8601 format
     * @return $this Fluent Builder
     */
    public function setDateCreatedAfter(\DateTime $dateCreatedAfter) : self
    {
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        return $this;
    }
    /**
     * Read only Participants that started before this date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601#UTC) format.
     *
     * @param \DateTime $dateCreatedBefore Read only Participants that started
     *                                     before this date in ISO 8601 format
     * @return $this Fluent Builder
     */
    public function setDateCreatedBefore(\DateTime $dateCreatedBefore) : self
    {
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
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
        return '[Twilio.Video.V1.ReadParticipantOptions ' . $options . ']';
    }
}
class UpdateParticipantOptions extends Options
{
    /**
     * @param string $status The new status of the resource
     */
    public function __construct(string $status = Values::NONE)
    {
        $this->options['status'] = $status;
    }
    /**
     * The new status of the resource. Can be: `connected` or `disconnected`. For `in-progress` Rooms the default Status is `connected`, for `completed` Rooms only `disconnected` Participants are returned.
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
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Video.V1.UpdateParticipantOptions ' . $options . ']';
    }
}

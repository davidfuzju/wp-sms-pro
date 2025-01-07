<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Video\V1\Room;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property string $status
 * @property \DateTime $dateCreated
 * @property string $sid
 * @property string $sourceSid
 * @property string $size
 * @property string $url
 * @property string $type
 * @property int $duration
 * @property string $containerFormat
 * @property string $codec
 * @property array $groupingSids
 * @property string $trackName
 * @property string $offset
 * @property string $mediaExternalLocation
 * @property string $roomSid
 * @property array $links
 */
class RoomRecordingInstance extends InstanceResource
{
    /**
     * Initialize the RoomRecordingInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $roomSid The SID of the Room resource the recording is
     *                        associated with
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function __construct(Version $version, array $payload, string $roomSid, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'status' => Values::array_get($payload, 'status'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'sid' => Values::array_get($payload, 'sid'), 'sourceSid' => Values::array_get($payload, 'source_sid'), 'size' => Values::array_get($payload, 'size'), 'url' => Values::array_get($payload, 'url'), 'type' => Values::array_get($payload, 'type'), 'duration' => Values::array_get($payload, 'duration'), 'containerFormat' => Values::array_get($payload, 'container_format'), 'codec' => Values::array_get($payload, 'codec'), 'groupingSids' => Values::array_get($payload, 'grouping_sids'), 'trackName' => Values::array_get($payload, 'track_name'), 'offset' => Values::array_get($payload, 'offset'), 'mediaExternalLocation' => Values::array_get($payload, 'media_external_location'), 'roomSid' => Values::array_get($payload, 'room_sid'), 'links' => Values::array_get($payload, 'links')];
        $this->solution = ['roomSid' => $roomSid, 'sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return RoomRecordingContext Context for this RoomRecordingInstance
     */
    protected function proxy() : RoomRecordingContext
    {
        if (!$this->context) {
            $this->context = new RoomRecordingContext($this->version, $this->solution['roomSid'], $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the RoomRecordingInstance
     *
     * @return RoomRecordingInstance Fetched RoomRecordingInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : RoomRecordingInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Delete the RoomRecordingInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->proxy()->delete();
    }
    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Video.V1.RoomRecordingInstance ' . \implode(' ', $context) . ']';
    }
}

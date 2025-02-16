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
 * @property string $roomSid
 * @property string[] $rules
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 */
class RecordingRulesInstance extends InstanceResource
{
    /**
     * Initialize the RecordingRulesInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $roomSid The SID of the Room resource for the Recording Rules
     */
    public function __construct(Version $version, array $payload, string $roomSid)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['roomSid' => Values::array_get($payload, 'room_sid'), 'rules' => Values::array_get($payload, 'rules'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated'))];
        $this->solution = ['roomSid' => $roomSid];
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
        return '[Twilio.Video.V1.RecordingRulesInstance]';
    }
}

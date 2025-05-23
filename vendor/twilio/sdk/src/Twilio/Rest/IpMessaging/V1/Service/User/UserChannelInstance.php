<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\IpMessaging\V1\Service\User;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property string $serviceSid
 * @property string $channelSid
 * @property string $memberSid
 * @property string $status
 * @property int $lastConsumedMessageIndex
 * @property int $unreadMessagesCount
 * @property array $links
 */
class UserChannelInstance extends InstanceResource
{
    /**
     * Initialize the UserChannelInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The service_sid
     * @param string $userSid The sid
     */
    public function __construct(Version $version, array $payload, string $serviceSid, string $userSid)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'serviceSid' => Values::array_get($payload, 'service_sid'), 'channelSid' => Values::array_get($payload, 'channel_sid'), 'memberSid' => Values::array_get($payload, 'member_sid'), 'status' => Values::array_get($payload, 'status'), 'lastConsumedMessageIndex' => Values::array_get($payload, 'last_consumed_message_index'), 'unreadMessagesCount' => Values::array_get($payload, 'unread_messages_count'), 'links' => Values::array_get($payload, 'links')];
        $this->solution = ['serviceSid' => $serviceSid, 'userSid' => $userSid];
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
        return '[Twilio.IpMessaging.V1.UserChannelInstance]';
    }
}

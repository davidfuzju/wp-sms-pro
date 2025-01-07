<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Chat\V2\Service\Channel;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class InviteOptions
{
    /**
     * @param string $roleSid The Role assigned to the new member
     * @return CreateInviteOptions Options builder
     */
    public static function create(string $roleSid = Values::NONE) : CreateInviteOptions
    {
        return new CreateInviteOptions($roleSid);
    }
    /**
     * @param string[] $identity The `identity` value of the resources to read
     * @return ReadInviteOptions Options builder
     */
    public static function read(array $identity = Values::ARRAY_NONE) : ReadInviteOptions
    {
        return new ReadInviteOptions($identity);
    }
}
class CreateInviteOptions extends Options
{
    /**
     * @param string $roleSid The Role assigned to the new member
     */
    public function __construct(string $roleSid = Values::NONE)
    {
        $this->options['roleSid'] = $roleSid;
    }
    /**
     * The SID of the [Role](https://www.twilio.com/docs/chat/rest/role-resource) assigned to the new member.
     *
     * @param string $roleSid The Role assigned to the new member
     * @return $this Fluent Builder
     */
    public function setRoleSid(string $roleSid) : self
    {
        $this->options['roleSid'] = $roleSid;
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
        return '[Twilio.Chat.V2.CreateInviteOptions ' . $options . ']';
    }
}
class ReadInviteOptions extends Options
{
    /**
     * @param string[] $identity The `identity` value of the resources to read
     */
    public function __construct(array $identity = Values::ARRAY_NONE)
    {
        $this->options['identity'] = $identity;
    }
    /**
     * The [User](https://www.twilio.com/docs/chat/rest/user-resource)'s `identity` value of the resources to read. See [access tokens](https://www.twilio.com/docs/chat/create-tokens) for more details.
     *
     * @param string[] $identity The `identity` value of the resources to read
     * @return $this Fluent Builder
     */
    public function setIdentity(array $identity) : self
    {
        $this->options['identity'] = $identity;
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
        return '[Twilio.Chat.V2.ReadInviteOptions ' . $options . ']';
    }
}

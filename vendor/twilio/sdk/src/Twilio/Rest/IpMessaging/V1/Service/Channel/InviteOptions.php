<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\IpMessaging\V1\Service\Channel;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class InviteOptions
{
    /**
     * @param string $roleSid The role_sid
     * @return CreateInviteOptions Options builder
     */
    public static function create(string $roleSid = Values::NONE) : CreateInviteOptions
    {
        return new CreateInviteOptions($roleSid);
    }
    /**
     * @param string[] $identity The identity
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
     * @param string $roleSid The role_sid
     */
    public function __construct(string $roleSid = Values::NONE)
    {
        $this->options['roleSid'] = $roleSid;
    }
    /**
     * The role_sid
     *
     * @param string $roleSid The role_sid
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
        return '[Twilio.IpMessaging.V1.CreateInviteOptions ' . $options . ']';
    }
}
class ReadInviteOptions extends Options
{
    /**
     * @param string[] $identity The identity
     */
    public function __construct(array $identity = Values::ARRAY_NONE)
    {
        $this->options['identity'] = $identity;
    }
    /**
     * The identity
     *
     * @param string[] $identity The identity
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
        return '[Twilio.IpMessaging.V1.ReadInviteOptions ' . $options . ']';
    }
}

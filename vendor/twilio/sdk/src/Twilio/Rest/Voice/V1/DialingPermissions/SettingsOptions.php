<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Voice\V1\DialingPermissions;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class SettingsOptions
{
    /**
     * @param bool $dialingPermissionsInheritance `true` for the sub-account to
     *                                            inherit voice dialing permissions
     *                                            from the Master Project;
     *                                            otherwise `false`
     * @return UpdateSettingsOptions Options builder
     */
    public static function update(bool $dialingPermissionsInheritance = Values::NONE) : UpdateSettingsOptions
    {
        return new UpdateSettingsOptions($dialingPermissionsInheritance);
    }
}
class UpdateSettingsOptions extends Options
{
    /**
     * @param bool $dialingPermissionsInheritance `true` for the sub-account to
     *                                            inherit voice dialing permissions
     *                                            from the Master Project;
     *                                            otherwise `false`
     */
    public function __construct(bool $dialingPermissionsInheritance = Values::NONE)
    {
        $this->options['dialingPermissionsInheritance'] = $dialingPermissionsInheritance;
    }
    /**
     * `true` for the sub-account to inherit voice dialing permissions from the Master Project; otherwise `false`.
     *
     * @param bool $dialingPermissionsInheritance `true` for the sub-account to
     *                                            inherit voice dialing permissions
     *                                            from the Master Project;
     *                                            otherwise `false`
     * @return $this Fluent Builder
     */
    public function setDialingPermissionsInheritance(bool $dialingPermissionsInheritance) : self
    {
        $this->options['dialingPermissionsInheritance'] = $dialingPermissionsInheritance;
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
        return '[Twilio.Voice.V1.UpdateSettingsOptions ' . $options . ']';
    }
}

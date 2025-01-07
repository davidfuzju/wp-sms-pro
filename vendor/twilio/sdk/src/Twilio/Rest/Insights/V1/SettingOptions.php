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
abstract class SettingOptions
{
    /**
     * @param string $subaccountSid The subaccount_sid
     * @return FetchSettingOptions Options builder
     */
    public static function fetch(string $subaccountSid = Values::NONE) : FetchSettingOptions
    {
        return new FetchSettingOptions($subaccountSid);
    }
    /**
     * @param bool $advancedFeatures The advanced_features
     * @param bool $voiceTrace The voice_trace
     * @param string $subaccountSid The subaccount_sid
     * @return UpdateSettingOptions Options builder
     */
    public static function update(bool $advancedFeatures = Values::NONE, bool $voiceTrace = Values::NONE, string $subaccountSid = Values::NONE) : UpdateSettingOptions
    {
        return new UpdateSettingOptions($advancedFeatures, $voiceTrace, $subaccountSid);
    }
}
class FetchSettingOptions extends Options
{
    /**
     * @param string $subaccountSid The subaccount_sid
     */
    public function __construct(string $subaccountSid = Values::NONE)
    {
        $this->options['subaccountSid'] = $subaccountSid;
    }
    /**
     * The subaccount_sid
     *
     * @param string $subaccountSid The subaccount_sid
     * @return $this Fluent Builder
     */
    public function setSubaccountSid(string $subaccountSid) : self
    {
        $this->options['subaccountSid'] = $subaccountSid;
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
        return '[Twilio.Insights.V1.FetchSettingOptions ' . $options . ']';
    }
}
class UpdateSettingOptions extends Options
{
    /**
     * @param bool $advancedFeatures The advanced_features
     * @param bool $voiceTrace The voice_trace
     * @param string $subaccountSid The subaccount_sid
     */
    public function __construct(bool $advancedFeatures = Values::NONE, bool $voiceTrace = Values::NONE, string $subaccountSid = Values::NONE)
    {
        $this->options['advancedFeatures'] = $advancedFeatures;
        $this->options['voiceTrace'] = $voiceTrace;
        $this->options['subaccountSid'] = $subaccountSid;
    }
    /**
     * The advanced_features
     *
     * @param bool $advancedFeatures The advanced_features
     * @return $this Fluent Builder
     */
    public function setAdvancedFeatures(bool $advancedFeatures) : self
    {
        $this->options['advancedFeatures'] = $advancedFeatures;
        return $this;
    }
    /**
     * The voice_trace
     *
     * @param bool $voiceTrace The voice_trace
     * @return $this Fluent Builder
     */
    public function setVoiceTrace(bool $voiceTrace) : self
    {
        $this->options['voiceTrace'] = $voiceTrace;
        return $this;
    }
    /**
     * The subaccount_sid
     *
     * @param string $subaccountSid The subaccount_sid
     * @return $this Fluent Builder
     */
    public function setSubaccountSid(string $subaccountSid) : self
    {
        $this->options['subaccountSid'] = $subaccountSid;
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
        return '[Twilio.Insights.V1.UpdateSettingOptions ' . $options . ']';
    }
}

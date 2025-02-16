<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Sync\Service;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class SyncMapOptions
{
    /**
     * @param string $uniqueName The unique_name
     * @return CreateSyncMapOptions Options builder
     */
    public static function create(string $uniqueName = Values::NONE) : CreateSyncMapOptions
    {
        return new CreateSyncMapOptions($uniqueName);
    }
}
class CreateSyncMapOptions extends Options
{
    /**
     * @param string $uniqueName The unique_name
     */
    public function __construct(string $uniqueName = Values::NONE)
    {
        $this->options['uniqueName'] = $uniqueName;
    }
    /**
     * The unique_name
     *
     * @param string $uniqueName The unique_name
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName) : self
    {
        $this->options['uniqueName'] = $uniqueName;
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
        return '[Twilio.Preview.Sync.CreateSyncMapOptions ' . $options . ']';
    }
}

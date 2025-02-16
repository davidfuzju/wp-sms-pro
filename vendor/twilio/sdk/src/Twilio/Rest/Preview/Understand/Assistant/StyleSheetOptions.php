<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class StyleSheetOptions
{
    /**
     * @param array $styleSheet The JSON Style sheet string
     * @return UpdateStyleSheetOptions Options builder
     */
    public static function update(array $styleSheet = Values::ARRAY_NONE) : UpdateStyleSheetOptions
    {
        return new UpdateStyleSheetOptions($styleSheet);
    }
}
class UpdateStyleSheetOptions extends Options
{
    /**
     * @param array $styleSheet The JSON Style sheet string
     */
    public function __construct(array $styleSheet = Values::ARRAY_NONE)
    {
        $this->options['styleSheet'] = $styleSheet;
    }
    /**
     * The JSON Style sheet string
     *
     * @param array $styleSheet The JSON Style sheet string
     * @return $this Fluent Builder
     */
    public function setStyleSheet(array $styleSheet) : self
    {
        $this->options['styleSheet'] = $styleSheet;
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
        return '[Twilio.Preview.Understand.UpdateStyleSheetOptions ' . $options . ']';
    }
}

<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Numbers\V2\RegulatoryCompliance;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class SupportingDocumentOptions
{
    /**
     * @param array $attributes The set of parameters that compose the Supporting
     *                          Documents resource
     * @return CreateSupportingDocumentOptions Options builder
     */
    public static function create(array $attributes = Values::ARRAY_NONE) : CreateSupportingDocumentOptions
    {
        return new CreateSupportingDocumentOptions($attributes);
    }
    /**
     * @param string $friendlyName The string that you assigned to describe the
     *                             resource
     * @param array $attributes The set of parameters that compose the Supporting
     *                          Document resource
     * @return UpdateSupportingDocumentOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, array $attributes = Values::ARRAY_NONE) : UpdateSupportingDocumentOptions
    {
        return new UpdateSupportingDocumentOptions($friendlyName, $attributes);
    }
}
class CreateSupportingDocumentOptions extends Options
{
    /**
     * @param array $attributes The set of parameters that compose the Supporting
     *                          Documents resource
     */
    public function __construct(array $attributes = Values::ARRAY_NONE)
    {
        $this->options['attributes'] = $attributes;
    }
    /**
     * The set of parameters that are the attributes of the Supporting Documents resource which are derived Supporting Document Types.
     *
     * @param array $attributes The set of parameters that compose the Supporting
     *                          Documents resource
     * @return $this Fluent Builder
     */
    public function setAttributes(array $attributes) : self
    {
        $this->options['attributes'] = $attributes;
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
        return '[Twilio.Numbers.V2.CreateSupportingDocumentOptions ' . $options . ']';
    }
}
class UpdateSupportingDocumentOptions extends Options
{
    /**
     * @param string $friendlyName The string that you assigned to describe the
     *                             resource
     * @param array $attributes The set of parameters that compose the Supporting
     *                          Document resource
     */
    public function __construct(string $friendlyName = Values::NONE, array $attributes = Values::ARRAY_NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['attributes'] = $attributes;
    }
    /**
     * The string that you assigned to describe the resource.
     *
     * @param string $friendlyName The string that you assigned to describe the
     *                             resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The set of parameters that are the attributes of the Supporting Document resource which are derived Supporting Document Types.
     *
     * @param array $attributes The set of parameters that compose the Supporting
     *                          Document resource
     * @return $this Fluent Builder
     */
    public function setAttributes(array $attributes) : self
    {
        $this->options['attributes'] = $attributes;
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
        return '[Twilio.Numbers.V2.UpdateSupportingDocumentOptions ' . $options . ']';
    }
}

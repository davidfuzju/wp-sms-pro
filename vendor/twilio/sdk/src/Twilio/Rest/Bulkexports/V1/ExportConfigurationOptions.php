<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Bulkexports\V1;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class ExportConfigurationOptions
{
    /**
     * @param bool $enabled Whether files are automatically generated
     * @param string $webhookUrl URL targeted at export
     * @param string $webhookMethod Whether to GET or POST to the webhook url
     * @return UpdateExportConfigurationOptions Options builder
     */
    public static function update(bool $enabled = Values::NONE, string $webhookUrl = Values::NONE, string $webhookMethod = Values::NONE) : UpdateExportConfigurationOptions
    {
        return new UpdateExportConfigurationOptions($enabled, $webhookUrl, $webhookMethod);
    }
}
class UpdateExportConfigurationOptions extends Options
{
    /**
     * @param bool $enabled Whether files are automatically generated
     * @param string $webhookUrl URL targeted at export
     * @param string $webhookMethod Whether to GET or POST to the webhook url
     */
    public function __construct(bool $enabled = Values::NONE, string $webhookUrl = Values::NONE, string $webhookMethod = Values::NONE)
    {
        $this->options['enabled'] = $enabled;
        $this->options['webhookUrl'] = $webhookUrl;
        $this->options['webhookMethod'] = $webhookMethod;
    }
    /**
     * If true, Twilio will automatically generate every day's file when the day is over.
     *
     * @param bool $enabled Whether files are automatically generated
     * @return $this Fluent Builder
     */
    public function setEnabled(bool $enabled) : self
    {
        $this->options['enabled'] = $enabled;
        return $this;
    }
    /**
     * Stores the URL destination for the method specified in webhook_method.
     *
     * @param string $webhookUrl URL targeted at export
     * @return $this Fluent Builder
     */
    public function setWebhookUrl(string $webhookUrl) : self
    {
        $this->options['webhookUrl'] = $webhookUrl;
        return $this;
    }
    /**
     * Sets whether Twilio should call a webhook URL when the automatic generation is complete, using GET or POST. The actual destination is set in the webhook_url
     *
     * @param string $webhookMethod Whether to GET or POST to the webhook url
     * @return $this Fluent Builder
     */
    public function setWebhookMethod(string $webhookMethod) : self
    {
        $this->options['webhookMethod'] = $webhookMethod;
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
        return '[Twilio.Bulkexports.V1.UpdateExportConfigurationOptions ' . $options . ']';
    }
}

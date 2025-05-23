<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Monitor\V1;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class AlertOptions
{
    /**
     * @param string $logLevel Only show alerts for this log-level
     * @param \DateTime $startDate Only include alerts that occurred on or after
     *                             this date and time
     * @param \DateTime $endDate Only include alerts that occurred on or before
     *                           this date and time
     * @return ReadAlertOptions Options builder
     */
    public static function read(string $logLevel = Values::NONE, \DateTime $startDate = Values::NONE, \DateTime $endDate = Values::NONE) : ReadAlertOptions
    {
        return new ReadAlertOptions($logLevel, $startDate, $endDate);
    }
}
class ReadAlertOptions extends Options
{
    /**
     * @param string $logLevel Only show alerts for this log-level
     * @param \DateTime $startDate Only include alerts that occurred on or after
     *                             this date and time
     * @param \DateTime $endDate Only include alerts that occurred on or before
     *                           this date and time
     */
    public function __construct(string $logLevel = Values::NONE, \DateTime $startDate = Values::NONE, \DateTime $endDate = Values::NONE)
    {
        $this->options['logLevel'] = $logLevel;
        $this->options['startDate'] = $startDate;
        $this->options['endDate'] = $endDate;
    }
    /**
     * Only show alerts for this log-level.  Can be: `error`, `warning`, `notice`, or `debug`.
     *
     * @param string $logLevel Only show alerts for this log-level
     * @return $this Fluent Builder
     */
    public function setLogLevel(string $logLevel) : self
    {
        $this->options['logLevel'] = $logLevel;
        return $this;
    }
    /**
     * Only include alerts that occurred on or after this date and time. Specify the date and time in GMT and format as `YYYY-MM-DD` or `YYYY-MM-DDThh:mm:ssZ`. Queries for alerts older than 30 days are not supported.
     *
     * @param \DateTime $startDate Only include alerts that occurred on or after
     *                             this date and time
     * @return $this Fluent Builder
     */
    public function setStartDate(\DateTime $startDate) : self
    {
        $this->options['startDate'] = $startDate;
        return $this;
    }
    /**
     * Only include alerts that occurred on or before this date and time. Specify the date and time in GMT and format as `YYYY-MM-DD` or `YYYY-MM-DDThh:mm:ssZ`. Queries for alerts older than 30 days are not supported.
     *
     * @param \DateTime $endDate Only include alerts that occurred on or before
     *                           this date and time
     * @return $this Fluent Builder
     */
    public function setEndDate(\DateTime $endDate) : self
    {
        $this->options['endDate'] = $endDate;
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
        return '[Twilio.Monitor.V1.ReadAlertOptions ' . $options . ']';
    }
}

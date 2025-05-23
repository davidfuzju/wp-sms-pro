<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace\Worker;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class WorkerChannelOptions
{
    /**
     * @param int $capacity The total number of Tasks that the Worker should handle
     *                      for the TaskChannel type
     * @param bool $available Whether the WorkerChannel is available
     * @return UpdateWorkerChannelOptions Options builder
     */
    public static function update(int $capacity = Values::NONE, bool $available = Values::NONE) : UpdateWorkerChannelOptions
    {
        return new UpdateWorkerChannelOptions($capacity, $available);
    }
}
class UpdateWorkerChannelOptions extends Options
{
    /**
     * @param int $capacity The total number of Tasks that the Worker should handle
     *                      for the TaskChannel type
     * @param bool $available Whether the WorkerChannel is available
     */
    public function __construct(int $capacity = Values::NONE, bool $available = Values::NONE)
    {
        $this->options['capacity'] = $capacity;
        $this->options['available'] = $available;
    }
    /**
     * The total number of Tasks that the Worker should handle for the TaskChannel type. TaskRouter creates reservations for Tasks of this TaskChannel type up to the specified capacity. If the capacity is 0, no new reservations will be created.
     *
     * @param int $capacity The total number of Tasks that the Worker should handle
     *                      for the TaskChannel type
     * @return $this Fluent Builder
     */
    public function setCapacity(int $capacity) : self
    {
        $this->options['capacity'] = $capacity;
        return $this;
    }
    /**
     * Whether the WorkerChannel is available. Set to `false` to prevent the Worker from receiving any new Tasks of this TaskChannel type.
     *
     * @param bool $available Whether the WorkerChannel is available
     * @return $this Fluent Builder
     */
    public function setAvailable(bool $available) : self
    {
        $this->options['available'] = $available;
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
        return '[Twilio.Taskrouter.V1.UpdateWorkerChannelOptions ' . $options . ']';
    }
}

<?php

namespace WP_SMS\Pro\Services\DynamicResponse;

use WP_SMS\Pro\Exceptions\BadMethodCallException;
class DynamicVariable
{
    /**
     * @var string
     */
    private $key;
    /**
     * @var mixed
     */
    private $value;
    /**
     * Constructor
     *
     * @param string $key
     * @param mixed $valueCallback
     */
    public function __construct($key, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
        // Null means class is instantiated for decoration
    }
    /**
     * Set value
     *
     * @param mixed $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
    /**
     * Get variable's resolved value
     *
     * @return mixed|null
     */
    public function getValue()
    {
        if ($this->value instanceof \Closure) {
            try {
                return \is_callable($this->value) ? \call_user_func($this->value) : null;
            } catch (\Throwable $e) {
                return;
            }
        }
        return $this->value;
    }
    /**
     * Get variable's key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}

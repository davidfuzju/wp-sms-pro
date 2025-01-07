<?php

namespace WP_SMS\Pro\Traits;

trait SingletonTrait
{
    private static $instance;
    /**
     * Get the single instance of class
     *
     * @return mixed
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function __clone()
    {
    }
    public function __sleep()
    {
    }
    public function __wakeup()
    {
    }
}

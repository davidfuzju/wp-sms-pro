<?php

use WPSmsPlugin\WPSmsPro;

if (!function_exists('WPSmsPro')) {
    /**
     * Alias function to access WPSmsPro's single instance
     *
     * @return WPSmsPro
     */
    function WPSmsPro()
    {
        if (class_exists(WPSmsPro::class)) {
            return WPSmsPro::getInstance();
        }
    }
}

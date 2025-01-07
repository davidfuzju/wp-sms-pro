<?php

namespace {
    use WP_SMS\Pro;
    if (!\defined('ABSPATH')) {
        exit;
    }
    // Exit if accessed directly
    /*
     * Load Defines
     */
    require_once 'defines.php';
    /*
     * Load Plugin
     */
    include_once 'class-wpsms-pro.php';
    Pro::get_instance();
}

<?php

namespace WP_SMS\Pro\Services\Controller;

class SendSmsBlockAjaxManager
{
    public static function init()
    {
        add_action('plugins_loaded', function () {
            \WP_SMS\Pro\Services\Controller\SendSmsBlockAjaxController::listen();
        }, \PHP_INT_MAX);
        // Make send SMS block visible
        add_filter('wp_sms_send_sms_block_visibility', '__return_true');
        // Pass SendFrontSmsAjax class to wp-sms-blocks-script
        add_filter('wp_sms_send_front_sms_ajax', function () {
            return \WP_SMS\Pro\Services\Controller\SendSmsBlockAjaxController::url();
        });
    }
}

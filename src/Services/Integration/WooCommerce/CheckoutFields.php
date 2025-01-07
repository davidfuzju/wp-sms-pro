<?php

namespace WP_SMS\Pro\Services\Integration\WooCommerce;

use WP_SMS\Option;
use WP_SMS\Version;
/**
 * Class CheckoutFields
 * @package WP_SMS\Pro\Services\Integration\WooCommerce
 */
class CheckoutFields
{
    public static function initConfirmationCheckbox()
    {
        $options = Option::getOptions(\true);
        $wooProIsInstalled = Version::pro_is_installed('wp-sms-woocommerce-pro/wp-sms-woocommerce-pro.php');
        if ($wooProIsInstalled && get_option('wpsmswoopro_checkout_confirmation_checkbox_enabled') !== 'yes' && isset($options['wc_checkout_confirmation_checkbox_enabled']) || !$wooProIsInstalled && isset($options['wc_checkout_confirmation_checkbox_enabled'])) {
            add_filter('wpsms_woocommerce_order_opt_in_notification', '__return_true');
        }
    }
}

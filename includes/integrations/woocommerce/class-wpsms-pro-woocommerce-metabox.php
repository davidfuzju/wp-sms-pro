<?php

namespace WP_SMS\Pro\WooCommerce;

use WP_SMS\Services\WooCommerce\OrderViewManager;
use WP_SMS\Option;
if (!\defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
class MetaBox
{
    public function __construct()
    {
        if (Option::getOption('wc_meta_box_enable', \true) && \class_exists(OrderViewManager::class) && \class_exists('WooCommerce')) {
            $wooCommerceAdminOrder = new OrderViewManager();
            $wooCommerceAdminOrder->init();
        }
    }
}
new \WP_SMS\Pro\WooCommerce\MetaBox();

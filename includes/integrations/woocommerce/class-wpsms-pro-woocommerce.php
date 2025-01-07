<?php

namespace WP_SMS\Pro;

use WP_SMS\Notification\NotificationFactory;
use WP_SMS\Option;
if (!\defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
/**
 * Class WooCommerce
 *
 */
class WooCommerce
{
    public $options;
    public function __construct()
    {
        $this->options = Option::getOptions(\true);
        if (isset($this->options['wc_notify_product_enable'])) {
            add_action('publish_product', array($this, 'notification_new_product'));
        }
        if (isset($this->options['wc_notify_order_enable'])) {
            add_action('woocommerce_store_api_checkout_order_processed', array($this, 'admin_notification_order'), \PHP_INT_MAX);
            add_action('woocommerce_checkout_order_processed', array($this, 'admin_notification_order'), \PHP_INT_MAX);
        }
        if (isset($this->options['wc_notify_customer_enable'])) {
            add_action('woocommerce_store_api_checkout_order_processed', array($this, 'customer_notification_order'), \PHP_INT_MAX);
            add_action('woocommerce_checkout_order_processed', array($this, 'customer_notification_order'), \PHP_INT_MAX);
        }
        if (isset($this->options['wc_notify_stock_enable'])) {
            add_action('woocommerce_low_stock', array($this, 'admin_notification_low_stock'));
            add_action('woocommerce_no_stock', array($this, 'admin_notification_low_stock'));
        }
        if (isset($this->options['wc_notify_status_enable'])) {
            add_action('woocommerce_order_edit_status', array($this, 'notification_change_order_status'), 10, 2);
        }
        if (isset($this->options['wc_notify_by_status_enable'])) {
            add_action('woocommerce_order_status_changed', array($this, 'notification_by_order_status'), 10, 3);
        }
    }
    /**
     * WooCommerce's notification new product
     *
     * @param $post_ID
     */
    public function notification_new_product($post_ID)
    {
        global $wpdb;
        $receiver = [];
        if ($this->options['wc_notify_product_receiver'] == 'subscriber') {
            if ($this->options['wc_notify_product_cat']) {
                $receiver = $wpdb->get_col("SELECT mobile FROM {$wpdb->prefix}sms_subscribes WHERE group_ID = '" . $this->options['wc_notify_product_cat'] . "'");
            } else {
                $receiver = $wpdb->get_col("SELECT mobile FROM {$wpdb->prefix}sms_subscribes WHERE status = 1");
            }
        } else {
            if ($this->options['wc_notify_product_receiver'] == 'users') {
                $roles = [];
                if (isset($this->options['wc_notify_product_roles'])) {
                    $roles = $this->options['wc_notify_product_roles'];
                }
                $customers_numbers = \WP_SMS\Helper::getWooCommerceCustomersNumbers($roles);
                if (!$customers_numbers) {
                    return;
                }
                $receiver = $customers_numbers;
            }
        }
        $message = $this->options['wc_notify_product_message'];
        // Fire notification
        $notification = NotificationFactory::getWooCommerceProduct($post_ID);
        $notification->send($message, $receiver);
    }
    /**
     * WooCommerce admin notification order
     *
     * @param $orderId
     */
    public function admin_notification_order($orderId)
    {
        $receiver = \explode(',', $this->options['wc_notify_order_receiver']);
        $message = $this->options['wc_notify_order_message'];
        // Fire notification
        $notification = NotificationFactory::getWooCommerceAdminOrder($orderId);
        $notification->send($message, $receiver);
    }
    /**
     * WooCommerce customer notification order
     *
     * @param $order_id
     */
    public function customer_notification_order($order_id)
    {
        // Get mobile number from
        $to = \WP_SMS\Helper::getWooCommerceCustomerNumberByOrderId($order_id);
        // Check mobile number has existed
        if (!$to) {
            return;
        }
        $message = $this->options['wc_notify_customer_message'];
        $receiver = array($to);
        // Fire notification
        $notification = NotificationFactory::getWooCommerceOrder($order_id);
        $notification->send($message, $receiver);
    }
    /**
     * WooCommerce's notification low stock
     *
     * @param $product \WC_Product
     */
    public function admin_notification_low_stock($product)
    {
        $receiver = \explode(',', $this->options['wc_notify_stock_receiver']);
        $message = $this->options['wc_notify_stock_message'];
        // Fire notification
        $notification = NotificationFactory::getWooCommerceProduct($product->get_id());
        $notification->send($message, $receiver);
    }
    /**
     * WooCommerce's notification change status
     *
     * @param $order_id
     * @param $new_status
     */
    public function notification_change_order_status($order_id, $new_status)
    {
        // Check Before Status Order Send SMS
        $last_status = get_post_meta($order_id, '_wp_sms_customer_order_status', \true);
        if (!empty($last_status) and $last_status == $new_status) {
            return;
        }
        // Get mobile number from
        $to = \WP_SMS\Helper::getWooCommerceCustomerNumberByOrderId($order_id);
        // Check mobile number has existed
        if (!$to) {
            return;
        }
        // Get new status name
        $newStatus = wc_get_order_status_name($new_status);
        // Replace new status in message
        $message = \str_replace('%status%', $newStatus, $this->options['wc_notify_status_message']);
        $receiver = array($to);
        // Fire notification
        $notification = NotificationFactory::getWooCommerceOrder($order_id);
        $notification->send($message, $receiver);
        // Update Post Meta
        update_post_meta($order_id, '_wp_sms_customer_order_status', $new_status);
    }
    /**
     * WooCommerce's notification by order status
     *
     * @param int $order_id
     * @param string $old_status
     * @param string $new_status
     */
    public function notification_by_order_status($order_id = 0, $old_status = '', $new_status = '')
    {
        // Get mobile number from
        $to = \WP_SMS\Helper::getWooCommerceCustomerNumberByOrderId($order_id);
        // Check mobile number has existed
        if (!$to) {
            return;
        }
        $sms_message = \false;
        $content = $this->options['wc_notify_by_status_content'];
        foreach ($content as $key => $value) {
            if ($value['notify_status'] == '1' && $value['order_status'] == $new_status) {
                $sms_message = $value['message'];
            }
        }
        if (!$sms_message) {
            return;
        }
        $receiver = array($to);
        // Fire notification
        $notification = NotificationFactory::getWooCommerceOrder($order_id);
        $notification->send($sms_message, $receiver);
    }
}
new \WP_SMS\Pro\WooCommerce();

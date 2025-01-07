<?php

namespace WP_SMS\Pro\Services\Integration\AwesomeSupport;

use WP_SMS\Option;
use WP_SMS\Helper;
use WP_SMS\Notification\NotificationFactory;
if (!\defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
class AwesomeSupport
{
    public static $options;
    public static $main_options;
    public static $mobile_field_name;
    private static $this_class = 'WP_SMS\\Pro\\Services\\Integration\\AwesomeSupport\\AwesomeSupport';
    public static function init()
    {
        self::$options = Option::getOptions(\true);
        self::$main_options = Option::getOptions();
        self::$mobile_field_name = Option::getOption('add_mobile_field');
        if (self::$mobile_field_name === 'add_mobile_field_in_profile') {
            // Add mobile field in the registration form
            add_action('wpas_after_registration_fields', array(self::$this_class, 'add_mobile_field_to_register_form'));
            // Save mobile field data into database
            add_action('wpas_register_account_after', array(self::$this_class, 'save_registration_mobile_field'), 10, 3);
        }
        // Check notify the new ticket option
        if (isset(self::$options['as_notify_open_ticket_status']) and self::$options['as_notify_open_ticket_status']) {
            add_action('wpas_open_ticket_after', array(self::$this_class, 'notify_new_ticket'), 10, 2);
        }
        // Check notify admin reply ticket option
        if (isset(self::$options['as_notify_admin_reply_ticket_status']) and self::$options['as_notify_admin_reply_ticket_status']) {
            add_action('wpas_add_reply_public_after', array(self::$this_class, 'notify_admin_reply'), 10, 2);
        }
        // Check notify for user reply ticket option
        if (isset(self::$options['as_notify_user_reply_ticket_status']) and self::$options['as_notify_user_reply_ticket_status']) {
            add_action('wpas_add_reply_admin_after', array(self::$this_class, 'notify_user_reply'), 10, 2);
        }
        // Check notify for the ticket status update option
        if (isset(self::$options['as_notify_update_ticket_status']) and self::$options['as_notify_update_ticket_status']) {
            add_action('post_updated', array(self::$this_class, 'notify_ticket_status_update'), 10, 3);
        }
        // Check notify for the ticket close and open option
        if (isset(self::$options['as_notify_close_ticket_status']) and self::$options['as_notify_close_ticket_status']) {
            add_action('wpas_after_close_ticket', array(self::$this_class, 'notify_ticket_closed'), 10, 3);
        }
    }
    /**
     * Add mobile field in the registration form
     */
    public static function add_mobile_field_to_register_form()
    {
        $mobile_field = new \WPAS_Custom_Field('mobile', array(
            'name' => 'mobile',
            // todo use Helper to get the correct key.
            'args' => array('required' => \true, 'spellcheck' => \false, 'field_type' => 'text', 'label' => __('Mobile', 'wp-sms-pro'), 'placeholder' => __('Mobile', 'wp-sms-pro'), 'sanitize' => 'sanitize_text_field', 'default' => isset($_SESSION["wpas_registration_form"]["mobile"]) && $_SESSION["wpas_registration_form"]["mobile"] ? $_SESSION["wpas_registration_form"]["mobile"] : ""),
        ));
        echo $mobile_field->get_output();
    }
    /**
     * Save mobile field data into database
     */
    public static function save_registration_mobile_field($user_id, $user, $data)
    {
        $mobile_number = $data['wpas_mobile'];
        $mobile_number = Helper::sanitizeMobileNumber($mobile_number);
        update_user_meta($user_id, 'mobile', $mobile_number);
    }
    /**
     * Notify new ticket
     *
     * @param $data
     * @param $post_id
     * @param $incoming_data
     */
    public static function notify_new_ticket($ticket_id, $data)
    {
        // Check admin mobile number
        if (empty(self::$main_options['admin_mobile_number'])) {
            return;
        }
        $message = self::$options['as_notify_open_ticket_message'];
        // Fire notification
        $notification = NotificationFactory::getAwesomeSupportTicket($ticket_id);
        $notification->send($message, self::$main_options['admin_mobile_number']);
    }
    /**
     * Notify admin reply ticket
     *
     * @param $reply_id
     * @param $data
     */
    public static function notify_admin_reply($reply_id, $data)
    {
        // Check admin mobile number
        if (empty(self::$main_options['admin_mobile_number'])) {
            return;
        }
        $message = self::$options['as_notify_admin_reply_ticket_message'];
        // Fire notification
        $notification = NotificationFactory::getAwesomeSupportTicket($reply_id);
        $notification->send($message, self::$main_options['admin_mobile_number']);
    }
    /**
     * Notify user reply ticket
     *
     * @param $reply_id
     * @param $data
     */
    public static function notify_user_reply($reply_id, $data)
    {
        $post = get_post($reply_id);
        $post_parent = get_post($post->post_parent);
        // Get user mobile
        $user_mobile = Helper::getUserMobileNumberByUserId($post_parent->post_author);
        // Check user mobile number
        if (!$user_mobile) {
            return;
        }
        $message = self::$options['as_notify_user_reply_ticket_message'];
        // Fire notification
        $notification = NotificationFactory::getAwesomeSupportTicket($reply_id);
        $notification->send($message, $user_mobile);
    }
    /**
     * Notify for the ticket status update
     */
    public static function notify_ticket_status_update($post_id, $post_after, $post_before)
    {
        // Check if the post type is ticket
        if ($post_before->post_type !== 'ticket') {
            return;
        }
        // Check if the status has been changed
        if ($post_before->post_status === $post_after->post_status) {
            return \false;
        }
        $user = get_userdata($post_after->post_author);
        $user_mobile = Helper::getUserMobileNumberByUserId($user->ID);
        // Check user mobile number
        if (!$user_mobile) {
            return;
        }
        $message = self::$options['as_notify_update_ticket_message'];
        // Fire notification
        $notification = NotificationFactory::getAwesomeSupportTicket($post_id);
        $notification->send($message, $user_mobile);
    }
    /**
     * Notify for the ticket close
     */
    public static function notify_ticket_closed($ticket_id, $update, $user_id)
    {
        $post = get_post($ticket_id);
        $user_mobile = Helper::getUserMobileNumberByUserId($post->post_author);
        // Check user mobile number
        if (!$user_mobile) {
            return;
        }
        $message = self::$options['as_notify_close_ticket_message'];
        // Fire notification
        $notification = NotificationFactory::getAwesomeSupportTicket($ticket_id);
        $notification->send($message, $user_mobile);
    }
}

<?php

namespace WP_SMS\Pro\Services\Integration\BuddyPress;

use WP_SMS\Option;
use WP_SMS\Helper;
if (!\defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
class BuddyPress
{
    public static $sms;
    public static $options;
    public static $mobile_field_id;
    private static $this_class = 'WP_SMS\\Pro\\Services\\Integration\\BuddyPress\\BuddyPress';
    public static function init()
    {
        global $sms;
        self::$sms = $sms;
        self::$options = Option::getOptions(\true);
        // Handle BuddyPress mobile field
        self::handle_mobile_field();
        add_action('bp_admin_init', array(self::$this_class, 'handle_mobile_field'), \PHP_INT_MAX);
        add_action('rest_api_init', array(self::$this_class, 'handle_mobile_field'), \PHP_INT_MAX);
        // Add action for mention notification
        if (isset(self::$options['bp_mention_enable'])) {
            add_action('bp_activity_sent_mention_email', array(self::$this_class, 'mention_notification'), 10, 5);
        }
        // Add action for comment reply notification
        if (isset(self::$options['bp_comments_reply_enable'])) {
            add_action('bp_activity_sent_reply_to_reply_notification', array(self::$this_class, 'comments_reply_notification'), 10, 3);
        }
        // Add action for comments activity notification
        if (isset(self::$options['bp_comments_activity_enable'])) {
            add_action('bp_activity_sent_reply_to_update_notification', array(self::$this_class, 'comments_activity_notification'), 10, 3);
        }
        // Add action for welcome notification
        if (isset(self::$options['bp_welcome_notification_enable'])) {
            add_action('bp_core_signup_user', array(self::$this_class, 'welcome_notification'), 10, 5);
        }
        // Add action for private message notification
        if (isset(self::$options['bp_private_message_enable'])) {
            add_action('messages_message_after_save', array(self::$this_class, 'private_message_notification'));
        }
        // When updating wpsms_settings execute sync_fields function
        $settings_name = "wpsms_settings";
        add_action("update_option_{$settings_name}", array(self::$this_class, 'sync_fields'), 10, 3);
    }
    /**
     *  Add BuddyPress mobile field to mobile field statuses list
     */
    public static function handle_mobile_field()
    {
        if (!\class_exists('BuddyPress')) {
            return;
        }
        add_filter('wp_sms_general_settings', function ($fields) {
            $fields['add_mobile_field']['options']['BuddyPress'] = ['new_buddypress_mobile_field' => __('Insert a mobile number field into profiles', 'wp-sms-pro'), 'use_buddypress_mobile_field' => __('Use the existing profile phone field', 'wp-sms-pro')];
            return $fields;
        });
        add_filter('wp_sms_mobile_filed_handler', function ($handlers) {
            $handlers['new_buddypress_mobile_field'] = \WP_SMS\Pro\Services\Integration\BuddyPress\BuddyPressNewMobileFieldHandler::class;
            $handlers['use_buddypress_mobile_field'] = \WP_SMS\Pro\Services\Integration\BuddyPress\BuddyPressUseMobileFieldHandler::class;
            return $handlers;
        });
        self::set_mobile_field_id();
    }
    public static function set_mobile_field_id()
    {
        $mobile_field_option = Option::getOption('add_mobile_field');
        if ($mobile_field_option == 'new_buddypress_mobile_field') {
            self::$mobile_field_id = \WP_SMS\Pro\Services\Integration\BuddyPress\BuddyPressNewMobileFieldHandler::get_mobile_field_id();
        } else {
            self::$mobile_field_id = \WP_SMS\Pro\Services\Integration\BuddyPress\BuddyPressUseMobileFieldHandler::get_mobile_field_id();
        }
    }
    public static function sync_fields($oldValue, $newValue, $option)
    {
        if (isset($newValue['bp_sync_fields']) && !isset($oldValue['bp_sync_fields'])) {
            global $wpdb;
            $buddyPressMobileFields = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}bp_xprofile_data WHERE field_id = %s", self::$mobile_field_id));
            foreach ($buddyPressMobileFields as $buddyPressField) {
                update_user_meta($buddyPressField->user_id, 'mobile', $buddyPressField->value);
            }
        }
    }
    /**
     * @return array[]
     */
    public static function getTotalMobileNumbers()
    {
        global $wpdb;
        return $wpdb->get_col($wpdb->prepare("SELECT `value` FROM {$wpdb->prefix}bp_xprofile_data WHERE field_id = %s", self::$mobile_field_id));
    }
    // Buddypress mention
    public static function mention_notification($activity, $subject, $message, $content, $receiver_user_id)
    {
        // Get user mobile
        $user_mobile = Helper::getUserMobileNumberByUserId($receiver_user_id);
        // Check the mobile
        if (!$user_mobile) {
            return;
        }
        $user_posted = get_userdata($activity->user_id);
        $user_receiver = get_userdata($receiver_user_id);
        $template_vars = array('%posted_user_display_name%' => $user_posted->display_name, '%primary_link%' => wp_sms_shorturl($activity->primary_link), '%time%' => $activity->date_recorded, '%message%' => $content, '%receiver_user_display_name%' => $user_receiver->display_name);
        $message = \str_replace(\array_keys($template_vars), \array_values($template_vars), self::$options['bp_mention_message']);
        wp_sms_send($user_mobile, $message);
    }
    // BuddyPress comments on reply
    public static function comments_reply_notification($activity_comment, $comment_id, $commenter_id)
    {
        // Load comment
        $comment = new \BP_Activity_Activity($comment_id);
        // Get user mobile
        $user_mobile = Helper::getUserMobileNumberByUserId($activity_comment->user_id);
        // Check the mobile
        if (!$user_mobile) {
            return;
        }
        $user_posted = get_userdata($commenter_id);
        $user_receiver = get_userdata($activity_comment->user_id);
        $template_vars = array('%posted_user_display_name%' => $user_posted->display_name, '%comment%' => $comment->content, '%receiver_user_display_name%' => $user_receiver->display_name);
        $message = \str_replace(\array_keys($template_vars), \array_values($template_vars), self::$options['bp_comments_reply_message']);
        wp_sms_send($user_mobile, $message);
    }
    // BuddyPress comments on activity
    public static function comments_activity_notification($activity, $comment_id, $commenter_id)
    {
        // Load comment
        $comment = new \BP_Activity_Activity($comment_id);
        // Get user mobile
        $user_mobile = Helper::getUserMobileNumberByUserId($activity->user_id);
        // Check the mobile
        if (!$user_mobile) {
            return;
        }
        $user_posted = get_userdata($commenter_id);
        $user_receiver = get_userdata($activity->user_id);
        $template_vars = array('%posted_user_display_name%' => $user_posted->display_name, '%comment%' => $comment->content, '%receiver_user_display_name%' => $user_receiver->display_name);
        $message = \str_replace(\array_keys($template_vars), \array_values($template_vars), self::$options['bp_comments_activity_message']);
        wp_sms_send($user_mobile, $message);
    }
    /**
     * @param $userId
     * @param $userLogin
     * @param $userPassword
     * @param $userEmail
     * @param $userMeta
     */
    public static function welcome_notification($userId, $userLogin, $userPassword, $userEmail, $userMeta)
    {
        // Get user mobile
        $userMobile = Helper::getUserMobileNumberByUserId($userId);
        // Check the mobile
        if (!$userMobile) {
            return;
        }
        $user = get_userdata($userId);
        $template_vars = array('%user_login%' => $userLogin, '%user_email%' => $userEmail, '%display_name%' => $user->display_name);
        $message = \str_replace(\array_keys($template_vars), \array_values($template_vars), self::$options['bp_welcome_notification_message']);
        wp_sms_send($userMobile, $message);
    }
    /**
     * @param $buddyPressMessages \BP_Messages_Message
     */
    public static function private_message_notification($buddyPressMessages)
    {
        $recipients = [];
        foreach ($buddyPressMessages->recipients as $recipient) {
            $recipients[] = Helper::getUserMobileNumberByUserId($recipient->user_id);
        }
        $senderUser = get_userdata($buddyPressMessages->sender_id);
        $messageUrl = esc_url(bp_members_get_user_url($buddyPressMessages->sender_id) . bp_get_messages_slug() . '/view/' . $buddyPressMessages->thread_id . '/');
        $template_vars = array('%sender_display_name%' => $senderUser->display_name, '%subject%' => $buddyPressMessages->subject, '%message%' => \strip_tags($buddyPressMessages->message), '%message_url%' => wp_sms_shorturl($messageUrl));
        $message = \str_replace(\array_keys($template_vars), \array_values($template_vars), self::$options['bp_private_message_content']);
        wp_sms_send($recipients, $message);
    }
}

<?php

namespace WP_SMS\Pro\Services\Integration\UltimateMember;

use WP_SMS\Option;
use WP_SMS\Helper;
use WP_SMS\Notification\NotificationFactory;
if (!\defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
class UltimateMember
{
    /**
     * Ultimate member's mobile field meta key selected by user
     *
     * @var string
     */
    public static $umMobileMetaKey = "mobile_number";
    /**
     * @var string
     */
    private static $mobileField;
    private static $this_class = 'WP_SMS\\Pro\\Services\\Integration\\UltimateMember\\UltimateMember';
    /**
     * UltimateMembers constructor.
     */
    public static function init()
    {
        // Handle BuddyPress mobile field
        self::handle_mobile_field();
        $mobile_meta_key = Option::getOption('um_sync_field_name');
        if ($mobile_meta_key) {
            self::$umMobileMetaKey = $mobile_meta_key;
        }
        if (Option::getOption('um_send_sms_after_approval', \true)) {
            add_action('um_after_user_is_approved', array(self::$this_class, 'send_sms_after_approve'), 10, 1);
        }
        $settings_name = "wpsms_settings";
        add_action("update_option_{$settings_name}", array(self::$this_class, 'sync_old_members'), 10, 3);
        add_action('um_before_update_profile', array(self::$this_class, 'save_custom_field'), 10, 2);
        add_filter('wp_sms_from_notify_user_register', array(self::$this_class, 'set_value'), 10, 1);
    }
    /**
     *  Add Ultimate Member mobile field to mobile field statuses list
     */
    public static function handle_mobile_field()
    {
        if (!\function_exists('um_user')) {
            return;
        }
        add_filter('wp_sms_general_settings', function ($fields) {
            $fields['add_mobile_field']['options']['Ultimate Member'] = ['use_ultimate_member_mobile_field' => 'Use the phone field from the registration form'];
            return $fields;
        });
        add_filter('wp_sms_mobile_filed_handler', function ($handlers) {
            $handlers['use_ultimate_member_mobile_field'] = \WP_SMS\Pro\Services\Integration\UltimateMember\UltimateMemberUseMobileFieldHandler::class;
            return $handlers;
        });
        self::$mobileField = Helper::getUserMobileFieldName();
    }
    /**
     * Send SMS after approve the user
     *
     * @param $user_id
     *
     */
    public static function send_sms_after_approve($user_id)
    {
        $message = Option::getOption('um_message_body', \true);
        if ($message) {
            $userMobile = Helper::getUserMobileNumberByUserId($user_id);
            $notification = NotificationFactory::getUser($user_id);
            $notification->send($message, $userMobile);
        }
    }
    /**
     * Save custom mobile field
     *
     * @param $changes
     * @param $user_id
     *
     * @return mixed
     */
    public static function save_custom_field($changes, $user_id)
    {
        update_user_meta($user_id, self::$mobileField, $changes[self::$umMobileMetaKey]);
        return $changes;
    }
    /**
     * Set filter value
     *
     * @param $value
     *
     * @return string
     */
    public static function set_value($value)
    {
        return isset($value[self::$umMobileMetaKey . '-' . $value['form_id']]) ? $value[self::$umMobileMetaKey . '-' . $value['form_id']] : '';
    }
    /**
     * Sync members registered before enabling sync new ultimate member users
     *
     * @param mix $old_value
     * @param mix $new_value
     * @param string $option
     * @return void
     */
    public static function sync_old_members($old_value, $new_value, $option)
    {
        if (isset($new_value['um_sync_previous_members']) && !isset($old_value['um_sync_previous_members'])) {
            global $wpdb;
            $mobile_meta_key = self::$umMobileMetaKey;
            $mobile_field = self::$mobileField;
            $results = $wpdb->get_results("SELECT * FROM {$wpdb->usermeta} a WHERE meta_key = '{$mobile_meta_key}' and NOT EXISTS(SELECT * FROM {$wpdb->usermeta} b WHERE b . user_id = a . user_id and b . meta_key = '{$mobile_field}' );");
            foreach ($results as $result) {
                update_user_meta($result->user_id, self::$mobileField, $result->meta_value);
            }
        }
    }
}

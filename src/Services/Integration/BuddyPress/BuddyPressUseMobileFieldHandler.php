<?php

namespace WP_SMS\Pro\Services\Integration\BuddyPress;

use WP_SMS\Option;
class BuddyPressUseMobileFieldHandler
{
    private static $mobile_field_id;
    public function register()
    {
        $selected_form_field = Option::getOption('bp_mobile_field_id');
        self::$mobile_field_id = $selected_form_field;
    }
    public function getMobileNumberByUserId($userId)
    {
        $value = bp_get_profile_field_data(['field' => self::$mobile_field_id, 'user_id' => $userId]);
        return \strip_tags($value);
    }
    public function getUserMobileFieldName()
    {
        $field_name = '';
        global $wpdb;
        $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}bp_xprofile_fields WHERE type = %s", 'telephone'));
        if ($result) {
            $field_name = $result->name;
        }
        return $field_name;
    }
    public static function get_mobile_field_id()
    {
        return self::$mobile_field_id;
    }
}

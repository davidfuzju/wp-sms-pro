<?php

namespace WP_SMS\Pro\Services\Integration\BuddyPress;

use WP_SMS\Option;
use WP_SMS\Helper;
class BuddyPressNewMobileFieldHandler
{
    private static $mobile_field = 'mobile';
    public function register()
    {
        global $wpdb;
        // If already did not added Mobile field to bp_xprofile_fields table, the add one
        $result = $wpdb->query($wpdb->prepare("SELECT * FROM {$wpdb->prefix}bp_xprofile_fields WHERE name = %s", 'Mobile'));
        if (!$result) {
            $this->add_mobile_field_to_user_profile();
            // Enable international intel input if enabled
            if (Option::getOption('international_mobile')) {
                add_filter('bp_xprofile_field_edit_html_elements', array($this, 'add_attribute'), 11);
            }
        }
    }
    public function getMobileNumberByUserId($userId)
    {
        $value = bp_get_profile_field_data(['field' => $this->get_mobile_field_id(), 'user_id' => $userId]);
        return \strip_tags($value);
    }
    public function getUserMobileFieldName()
    {
        return self::$mobile_field;
    }
    /**
     * Add class to mobile attribute
     *
     * @param $r
     *
     * @return array
     */
    public function add_attribute($r)
    {
        $field_name = bp_get_the_profile_field_name();
        if ($field_name == 'Mobile') {
            $new_attribute['class'] = 'wp-sms-input-mobile';
            $attributes = \array_merge($new_attribute, $r);
        } else {
            $attributes = $r;
        }
        return $attributes;
    }
    /**
     * Add mobile field to user profile ( Extended Profile Section )
     */
    public function add_mobile_field_to_user_profile()
    {
        global $bp;
        $xfield_args = array('field_group_id' => 1, 'name' => 'Mobile', 'description' => __('Your mobile number to receive SMS updates', 'wp-sms-pro'), 'can_delete' => \true, 'field_order' => 1, 'is_required' => \false, 'type' => 'textbox');
        xprofile_insert_field($xfield_args);
    }
    public static function get_mobile_field_id()
    {
        global $wpdb;
        $field = $wpdb->get_row($wpdb->prepare("SELECT `id` FROM {$wpdb->prefix}bp_xprofile_fields WHERE name = %s", 'Mobile'));
        return $field->id;
    }
}

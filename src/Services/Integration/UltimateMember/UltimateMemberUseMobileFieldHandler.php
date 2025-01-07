<?php

namespace WP_SMS\Pro\Services\Integration\UltimateMember;

use WP_SMS\Helper;
class UltimateMemberUseMobileFieldHandler
{
    private $mobile_field = 'mobile_number';
    public function register()
    {
        // Add mobile number field to the user edit account page
        add_filter('um_account_tab_general_fields', array($this, 'addMobileFieldToAccount'), 12, 2);
        add_action('um_submit_account_errors_hook', array($this, 'checkMobileFieldValidity'));
    }
    public function getMobileNumberByUserId($userId)
    {
        $user_meta = get_user_meta($userId, $this->mobile_field);
        if (\count($user_meta)) {
            return $user_meta[0];
        }
    }
    public function getUserMobileFieldName()
    {
        return $this->mobile_field;
    }
    public function addMobileFieldToAccount($args, $shortcode_args)
    {
        // Add mobile_meta_key to arguments
        $args .= ',' . \WP_SMS\Pro\Services\Integration\UltimateMember\UltimateMember::$umMobileMetaKey;
        return $args;
    }
    public function checkMobileFieldValidity($args)
    {
        if (\array_key_exists(\WP_SMS\Pro\Services\Integration\UltimateMember\UltimateMember::$umMobileMetaKey, $args)) {
            //  check mobile number validity
            $mobileNumber = $args[\WP_SMS\Pro\Services\Integration\UltimateMember\UltimateMember::$umMobileMetaKey];
            $user = get_user_by('login', $args['user_login']);
            if ($user) {
                $checkValidity = Helper::checkMobileNumberValidity($mobileNumber, $user->ID);
                if (is_wp_error($checkValidity)) {
                    UM()->form()->add_error(\WP_SMS\Pro\Services\Integration\UltimateMember\UltimateMember::$umMobileMetaKey, __($checkValidity->get_error_message(), 'wp-sms-pro'));
                }
            }
        }
    }
}

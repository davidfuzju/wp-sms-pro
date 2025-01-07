<?php

namespace WP_SMS\Pro\Services\DynamicResponse\Delegates;

use WP_SMS\Pro\Services\DynamicResponse\ResponseDelegateAbstract;
use WP_SMS\Helper;
/**
 * @inheritDoc
 */
class LoginWithSmsDelegate extends ResponseDelegateAbstract
{
    public function checkRequirements()
    {
        return \true;
    }
    public function addDelegateVariables()
    {
        $response = $this->getResponse();
        $otp = $this->getData('otp');
        $user = Helper::getUserByPhoneNumber($response->getPhoneNumber());
        $response->addMultipleVariables(['code' => function () use($otp) {
            return isset($otp) ? $otp->getCode() : null;
        }, 'user_name' => function () use($user) {
            return isset($user) ? $user->user_login : null;
        }, 'full_name' => function () use($user) {
            return isset($user) ? $user->first_name . ' ' . $user->last_name : null;
        }, 'site_name' => function () {
            return get_bloginfo('name');
        }, 'site_url' => function () {
            return wp_sms_shorturl(get_bloginfo('url'));
        }]);
    }
}

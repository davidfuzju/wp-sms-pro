<?php

namespace WP_SMS\Pro\Services\DynamicResponse\Delegates;

use WP_SMS\Pro\Services\DynamicResponse\ResponseDelegateAbstract;
use WP_SMS\Helper;
/**
 * @inheritDoc
 */
class TwoFactorAuthenticationDelegate extends ResponseDelegateAbstract
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
        $response->addMultipleVariables(['otp' => function () use($otp) {
            return isset($otp) ? $otp->getCode() : null;
        }, 'user_name' => function () use($user) {
            return isset($user) ? $user->user_login : null;
        }, 'first_name' => function () use($user) {
            return isset($user) ? $user->first_name : null;
        }, 'last_name' => function () use($user) {
            return isset($user) ? $user->last_name : null;
        }]);
    }
}

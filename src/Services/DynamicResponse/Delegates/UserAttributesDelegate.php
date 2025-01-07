<?php

namespace WP_SMS\Pro\Services\DynamicResponse\Delegates;

use WP_SMS\Pro\Services\DynamicResponse\ResponseDelegateAbstract;
use WP_SMS\Helper;
/**
 * @inheritDoc
 */
class UserAttributesDelegate extends ResponseDelegateAbstract
{
    public function checkRequirements()
    {
        return \true;
    }
    public function addDelegateVariables()
    {
        $response = $this->getResponse();
        $user = Helper::getUserByPhoneNumber($response->getPhoneNumber());
        $response->addVariable('userName', function () use($user) {
            return isset($user) ? $user->user_login : null;
        });
        $response->addVariable('userEmail', function () use($user) {
            return isset($user) ? $user->user_email : null;
        });
        $response->addVariable('userDisplayName', function () use($user) {
            return isset($user) ? $user->display_name : null;
        });
    }
}

<?php

namespace WP_SMS\Pro\Services\Admin;

use WP_SMS\Option as WPSmsOptionsManager;
use WPSmsPro\Vendor\League\Container\ServiceProvider\AbstractServiceProvider;
use WPSmsPro\Vendor\League\Container\ServiceProvider\BootableServiceProviderInterface;
class AdminServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [];
    public function boot()
    {
        add_action('plugins_loaded', function () {
            if (WPSmsOptionsManager::getOption('login_sms', \true)) {
                \WP_SMS\Pro\Services\Admin\LoginForm\LoginWithSmsOtp::init();
            }
            if (WPSmsOptionsManager::getOption('mobile_verify', \true)) {
                \WP_SMS\Pro\Services\Admin\LoginForm\TwoFactorAuthentication::init();
            }
        });
    }
    public function register()
    {
    }
}

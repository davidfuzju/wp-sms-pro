<?php

namespace WP_SMS\Pro\Services\RepeatingMessages;

use WPSmsPro\Vendor\League\Container\ServiceProvider\AbstractServiceProvider;
use WPSmsPro\Vendor\League\Container\ServiceProvider\BootableServiceProviderInterface;
class RepeatingMessagesServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [];
    public function boot()
    {
        add_action('init', function () {
            \WP_SMS\Pro\Services\RepeatingMessages\RepeatingMessages::init();
        });
    }
    public function register()
    {
    }
}

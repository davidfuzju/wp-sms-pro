<?php

namespace WP_SMS\Pro\Services\Integration;

use WPSmsPro\Vendor\League\Container\ServiceProvider\AbstractServiceProvider;
use WPSmsPro\Vendor\League\Container\ServiceProvider\BootableServiceProviderInterface;
class IntegrationServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [];
    public function boot()
    {
        add_action('woocommerce_init', function () {
            \WP_SMS\Pro\Services\Integration\WooCommerce\CheckoutFields::initConfirmationCheckbox();
        });
        // Start using of WP SMS services for Ultimate Member and BuddyPress plugins
        add_action('init', function () {
            \WP_SMS\Pro\Services\Integration\BuddyPress\BuddyPress::init();
            \WP_SMS\Pro\Services\Integration\UltimateMember\UltimateMember::init();
            \WP_SMS\Pro\Services\Integration\AwesomeSupport\AwesomeSupport::init();
        });
    }
    public function register()
    {
    }
}

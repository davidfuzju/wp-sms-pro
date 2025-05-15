<?php

/**
 * Plugin Name: WP SMS Pro Pack
 * Plugin URI: https://wp-sms-pro.com/
 * Description: The professional pack adds many features, supports the most popular SMS gateways, and also integrates with other plugins.
 * Version: 4.3.7.3
 * Author: VeronaLabs
 * Author URI: https://veronalabs.com/
 * Text Domain: wp-sms-pro
 * Domain Path: /languages
 * Requires Plugins:  wp-sms
 */

namespace WPSmsPlugin;

if (\file_exists(\dirname(__FILE__) . '/vendor/autoload.php')) {
    require \dirname(__FILE__) . '/vendor/autoload.php';
}
// Set the plugin version
\define('WP_SMS_PRO_VERSION', '4.3.7.3');
/*
 * Load Legacy functionalities
 */
require_once \dirname(__FILE__) . '/includes/bootstrap.php';

use WP_SMS\Pro\BasePluginAbstract;
use WP_SMS\Pro\Traits\SingletonTrait;
use WP_SMS\Pro\Services as InternalServices;
use WP_SMS\Pro\Exceptions\RequirementsNotMetException;

class WPSmsPro extends BasePluginAbstract
{
    use SingletonTrait;
    private $pluginServiceProviders = [InternalServices\Admin\AdminServiceProvider::class, InternalServices\RepeatingMessages\RepeatingMessagesServiceProvider::class, InternalServices\Integration\IntegrationServiceProvider::class, InternalServices\Controller\ControllerServiceProvider::class];
    /**
     * Init the plugin
     *
     * @return void
     */
    public function init()
    {
        try {
            $this->checkPluginDependencies();
            $this->loadPluginServiceProviders();
        } catch (RequirementsNotMetException $error) {
            //TODO - skipping, appropriate actions have been taken in the legacy part.
            \error_log($error->getMessage());
        } catch (\Throwable $error) {
            \error_log($error->getMessage());
        }
    }
    /**
     * Check plugin dependencies
     *
     * @return void
     */
    private function checkPluginDependencies()
    {
        //Check if WP SMS is active
        if (!is_plugin_active('wp-sms/wp-sms.php')) {
            throw new RequirementsNotMetException();
        }
    }
    /**
     * Load plugin's service providers
     *
     * @return void
     */
    private function loadPluginServiceProviders()
    {
        foreach ($this->pluginServiceProviders as $provider) {
            $this->addServiceProvider(new $provider());
        }
    }
}
WPSmsPro()->init();

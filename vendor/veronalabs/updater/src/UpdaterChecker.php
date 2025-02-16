<?php

namespace WPSmsPro\Vendor\VeronaLabs\Updater;

use Puc_v4_Factory;
/**
 * Class UpdaterChecker
 * @package VeronaLabs\Updater
 */
class UpdaterChecker
{
    private static $instance = null;
    private $pluginSlug;
    private $pluginPath;
    private $websiteUrl;
    private $licenseKey;
    private $settingPageUrl;
    private $transientKey;
    /**
     * Check plugin update checker
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->setConfig($config);
        $this->setDefines();
        $this->init();
    }
    /**
     * @param $config
     * @return void
     */
    private function setConfig($config)
    {
        $this->pluginSlug = $config['plugin_slug'];
        $this->pluginPath = $config['plugin_path'];
        $this->websiteUrl = $config['website_url'];
        $this->licenseKey = $config['license_key'];
        $this->settingPageUrl = $config['setting_page'];
    }
    private function setDefines()
    {
        $this->transientKey = "{$this->pluginSlug}_download_info";
    }
    private function init()
    {
        if ($this->licenseKey == '') {
            add_action('after_plugin_row', [$this, 'showPluginRowNotice'], 10, 3);
        } elseif ($this->isPluginPage()) {
            add_action('admin_init', [$this, 'plugin_update_checker']);
        }
    }
    /**
     * @return UpdaterChecker|null
     */
    public static function getInstance($config)
    {
        if (self::$instance == null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }
    /**
     * Check is WordPress Admin Plugins Page
     */
    public function isPluginPage()
    {
        if (is_admin() and (\strpos($_SERVER['REQUEST_URI'], 'plugins.php') !== \false or \strpos($_SERVER['REQUEST_URI'], 'plugin-install.php') !== \false or isset($_REQUEST['slug']) and $_REQUEST['slug'] == $this->pluginSlug)) {
            return \true;
        }
    }
    public function getRemoteRequestUrl()
    {
        return add_query_arg(['plugin-name' => $this->pluginSlug, 'license_key' => $this->licenseKey, 'website' => get_bloginfo('url'), 'email' => get_bloginfo('admin_email')], $this->websiteUrl . '/wp-json/plugins/v1/download');
    }
    private function getRemoteDownloadInfo()
    {
        // Get any existing copy of our transient data
        if (\false === ($response = get_transient($this->transientKey))) {
            // Request to license server
            $response = wp_remote_get($this->getRemoteRequestUrl());
            if (is_wp_error($response)) {
                return \false;
            }
            if (wp_remote_retrieve_response_code($response) == '200') {
                $body = wp_remote_retrieve_body($response);
                $response = \json_decode($body, \true);
                set_transient($this->transientKey, $response, DAY_IN_SECONDS);
            }
        }
        return $response;
    }
    /**
     * Plugin Update Checker
     */
    public function plugin_update_checker()
    {
        $response = $this->getRemoteDownloadInfo();
        if ($response == null) {
            return;
        }
        // Check item require
        $require_item = array('name', 'version', 'download_url');
        $error = \false;
        // Check every item
        foreach ($require_item as $key) {
            if (\array_key_exists($key, $response)) {
                if (wp_strip_all_tags($response[$key]) == "") {
                    $error = \true;
                }
            } else {
                $error = \true;
            }
        }
        // Remote To server
        if (!$error) {
            Puc_v4_Factory::buildUpdateChecker($this->getRemoteRequestUrl(), $this->pluginPath, $this->pluginSlug);
        } else {
            add_action('after_plugin_row', array($this, 'showPluginRowNotice'), 10, 3);
        }
    }
    /**
     * Plugin update message
     *
     * @param $plugin_file
     * @param $plugin_data
     * @param $status
     *
     * @see https://developer.wordpress.org/reference/hooks/after_plugin_row/
     */
    public function showPluginRowNotice($plugin_file, $plugin_data, $status)
    {
        if ($plugin_file == $this->pluginSlug . '/' . $this->pluginSlug . '.php') {
            // Get the columns for this table so we can calculate the colspan attribute.
            $screen = get_current_screen();
            $columns = get_column_headers($screen);
            // If something went wrong with retrieving the columns, default to 3 for colspan.
            $colspan = !\is_countable($columns) ? 3 : \count($columns);
            // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
            <tr class='plugin-update-tr update active' data-plugin='<?php 
            echo esc_attr($plugin_file);
            ?>' data-plugin-row-type='feature-incomp-warn'>
                <td colspan='<?php 
            echo esc_attr($colspan);
            ?>' class='plugin-update'>
                    <div class='notice inline notice-warning notice-alt'>
                        <p>
                            <?php 
            echo \sprintf(__('<i>Automatic update is unavailable for the %s plugin.</i>', $this->pluginSlug), esc_attr($plugin_data['Name']));
            ?>
                            <br/>
                            <?php 
            echo \sprintf(__('To enable automatic updates with new features and security improvements, input your license key in <a href="%s">Settings page</a>. Don\'t have a license key? Review our <a href="%s">details & pricing</a>.', $this->pluginSlug), esc_url($this->settingPageUrl), esc_url($this->websiteUrl));
            ?>
                        </p>
                    </div>
                </td>
            </tr>
            <?php 
            // phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}

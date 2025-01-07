<?php

namespace WP_SMS\Pro;

use WPSmsPro\Vendor\League\Container\Container;
use ReflectionClass;
abstract class BasePluginAbstract extends Container
{
    /**
     * @var string
     */
    protected $pluginName;
    /**
     * @var string
     */
    protected $pluginPrefix;
    /**
     * @var string
     */
    protected $pluginFilePath;
    /**
     * @var array
     */
    protected $pluginHeaderData;
    public function __construct()
    {
        parent::__construct();
        add_action('init', function () {
            $this->setPluginFilePath();
            $this->setPluginHeaderData();
            $this->setPluginNameAndPrefix();
        });
    }
    /**
     * Set plugin's entry file path
     *
     * @return void
     */
    private function setPluginFilePath()
    {
        $this->pluginFilePath = (new ReflectionClass(static::class))->getFileName();
    }
    /**
     * Set plugin's name
     *
     * Provide a $name argument to overwrite default value, which is entry class's short name
     *
     * @param string|null $name
     * @return void
     */
    protected function setPluginNameAndPrefix($name = null)
    {
        $this->pluginName = empty($name) ? (new ReflectionClass(static::class))->getShortName() : $name;
        \preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $this->pluginName, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == \strtoupper($match) ? \strtolower($match) : \lcfirst($match);
        }
        $this->pluginPrefix = \implode('-', $ret);
    }
    /**
     * Set plugin's header data
     *
     * @return void
     */
    private function setPluginHeaderData()
    {
        $this->pluginHeaderData = get_plugin_data($this->pluginFilePath);
    }
    /**
     * Get a URL starting from plugin's root
     *
     * @param string $path
     * @return string
     */
    public function getUrl($path = '')
    {
        return plugins_url($path, $this->pluginFilePath);
    }
    /**
     * Get absolute path of a file inside the plugin
     *
     * Leave the $path parameter empty to return plugin's entry file path
     *
     * @param string $path relative to plugin's root
     * @return string
     */
    public function getPath($path = '')
    {
        return empty($path) ? $this->pluginFilePath : plugin_dir_path($this->pluginFilePath) . $path;
    }
    /**
     * Get a value from plugin header
     *
     * Leave the $key parameter to return all values
     *
     * @param string $key
     * @return string|array
     */
    public function getPluginHeader($key = '')
    {
        if (empty($key)) {
            return $this->pluginHeaderData;
        }
        return isset($this->pluginHeaderData[$key]) ? $this->pluginHeaderData[$key] : null;
    }
    /**
     * Enqueue an script
     *
     * @param string $scriptPath
     * @param array $dependencies
     * @param boolean $inFooter
     * @return string|false returns $scriptHandle on success, false on failure
     */
    public function enqueueScript($scriptPath, $dependencies = [], $inFooter = \false)
    {
        if (!\file_exists($this->getPath($scriptPath))) {
            return \false;
        }
        $pathInfo = \pathinfo($this->getPath($scriptPath));
        $scriptHandle = $this->pluginPrefix . "-" . $pathInfo['filename'];
        $scriptUrl = $this->getUrl($scriptPath);
        $pluginVersion = $this->getPluginHeader('Version');
        wp_enqueue_script($scriptHandle, $scriptUrl, $dependencies, $pluginVersion, $inFooter);
        return $scriptHandle;
    }
    /**
     * Enqueue a stylesheet
     *
     * @param string $styleSheetPath
     * @param array $dependencies
     * @return string|false returns $scriptHandle on success, false on failure
     */
    public function enqueueStyle($styleSheetPath, $dependencies = [])
    {
        if (!\file_exists($this->getPath($styleSheetPath))) {
            return \false;
        }
        $pathInfo = \pathinfo($this->getPath($styleSheetPath));
        $styleSheetHandle = $this->pluginPrefix . "-" . $pathInfo['filename'];
        $styleSheetUrl = $this->getUrl($styleSheetPath);
        $pluginVersion = $this->getPluginHeader('Version');
        wp_enqueue_style($styleSheetHandle, $styleSheetUrl, $dependencies, $pluginVersion);
        return $styleSheetHandle;
    }
}

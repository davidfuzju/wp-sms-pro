<?php

namespace WP_SMS\Pro\Utils\Recaptcha;

use WP_SMS\Pro\Exceptions\BadMethodCallException;
use WP_SMS\Option as WPSmsOptionsManager;
use DOMDocument;
use DOMXPath;
class Recaptcha
{
    public const RENDER_EXPLICITLY = 'explicit';
    public const RENDER_AUTOMATICALLY = 'automatically';
    private $siteKey;
    private $secretKey;
    private $renderMode = self::RENDER_AUTOMATICALLY;
    /**
     * @param string $siteKey
     * @param string $secretKey
     */
    public function __construct($siteKey, $secretKey)
    {
        $this->siteKey = $siteKey;
        $this->secretKey = $secretKey;
        $this->addExtraAttributesToScript();
    }
    /**
     * Make a recaptcha instance from wp-sms settings
     *
     * @return static
     */
    public static function makeFromWPSmsSettings()
    {
        $isActive = (bool) WPSmsOptionsManager::getOption('g_recaptcha_status');
        if (!$isActive) {
            return;
        }
        $siteKey = WPSmsOptionsManager::getOption('g_recaptcha_site_key');
        $secretKey = WPSmsOptionsManager::getOption('g_recaptcha_secret_key');
        return new self($siteKey, $secretKey);
    }
    /**
     * Get recatptcha siteKey, set in wp-sms settings
     *
     * @return void
     */
    public function getSiteKey()
    {
        return $this->siteKey;
    }
    /**
     * Enqueue assets for g-recaptcha
     *
     * @param array $args
     * @return static
     */
    public function enqueueApiScript($args = [])
    {
        wp_enqueue_script('wp-sms-g-recaptcha-api-script', $this->getApiScriptUrl($args), [], null, \false);
        return $this;
    }
    /**
     * Add `defer` and `async` attributes to enqueued api.js script tag
     *
     * @return void
     */
    private function addExtraAttributesToScript()
    {
        add_filter('script_loader_tag', function ($tag, $handle) {
            if ($handle == 'wp-sms-g-recaptcha-api-script') {
                $dom = new DOMDocument();
                $dom->loadHtml($tag);
                $domElement = (new DOMXPath($dom))->query("//script")->item(0);
                if (isset($domElement)) {
                    $domElement->setAttribute('async', 'async');
                    $domElement->setAttribute('defer', 'defer');
                    $tag = $dom->saveHtml($domElement);
                }
            }
            return $tag;
        }, 10, 2);
    }
    /**
     * Get script api url
     *
     * @param array $args
     * @return void
     */
    public function getApiScriptUrl($args = [])
    {
        if ($this->renderMode == self::RENDER_EXPLICITLY) {
            $args = \array_merge($args, ['render' => 'explicit']);
        }
        $args = \array_map(function ($value) {
            return \urlencode($value);
        }, $args);
        return add_query_arg($args, 'https://www.google.com/recaptcha/api.js');
    }
    /**
     * Verify client recaptcha response
     *
     * @param string $clientResponse
     * @return boolean
     */
    public function verifyUserResponse($clientResponse)
    {
        $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', ['body' => ['secret' => $this->secretKey, 'response' => $clientResponse], 'headers' => ['Content-Type' => 'application/x-www-form-urlencoded']]);
        $response = \json_decode(wp_remote_retrieve_body($response));
        return isset($response) && $response->success == \true;
    }
}

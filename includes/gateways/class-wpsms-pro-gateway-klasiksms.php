<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
/**
 * Class klasiksms
 *
 * Website: https://www.klasiksms.com/
 * API Documentation: https://www.klasiksms.com/apiIntegration.php
 *
 * @package WP_SMS\Gateway
 */
class klasiksms extends Gateway
{
    private $wsdl_link = "https://www.klasiksms.com/api/sendsms.php";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
        $this->gatewayFields = ['email' => ['id' => 'email', 'name' => __('Email', 'wp-sms'), 'desc' => __('Enter your email', 'wp-sms')], 'key' => ['id' => 'key', 'name' => __('API Key', 'wp-sms'), 'desc' => __('Enter your API KEY', 'wp-sms')]];
    }
    public function SendSMS()
    {
        /**
         * Modify sender number
         *
         * @param string $this - >from sender number.
         *
         * @since 3.4
         *
         */
        $this->from = apply_filters('wp_sms_from', $this->from);
        /**
         * Modify Receiver number
         *
         * @param array $this - >to receiver number
         *
         * @since 3.4
         *
         */
        $this->to = apply_filters('wp_sms_to', $this->to);
        /**
         * Modify text message
         *
         * @param string $this - >msg text message.
         *
         * @since 3.4
         *
         */
        $this->msg = apply_filters('wp_sms_msg', $this->msg);
        try {
            $recipient = \str_replace(' ', '', \implode(";", $this->to));
            $params = ['email' => $this->email, 'key' => $this->key, 'recipient' => $recipient, 'message' => $this->msg, 'referenceID' => \time()];
            $response = $this->request('POST', $this->wsdl_link, [], $params, \false);
            if (isset($response->error)) {
                throw new Exception($response->error);
            }
            $response = \simplexml_load_string($response);
            if ($response->statusCode != 'X7021') {
                throw new Exception($response->statusMsg);
            }
            $this->log($this->from, $this->msg, $this->to, $response);
            /**
             * Run hook after send sms.
             *
             * @param string $response result output.
             *
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $response);
            return $response;
        } catch (Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new WP_Error('send - sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        return 'Unable to check balance!';
    }
}

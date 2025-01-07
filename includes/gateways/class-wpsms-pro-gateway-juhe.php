<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
use WP_SMS\Helper;
class juhe extends Gateway
{
    private $wsdl_link = "http://v.juhe.cn/sms/send";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $gateway_key;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \false;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
        $this->validateNumber = "Only one number and receiver number without country code";
        $this->help = "For send messages, send variables and message id in this format: <b>message|template_id</b> For example: #code#=1234|123456";
        $this->gatewayFields = ['gateway_key' => ['id' => 'gateway_key', 'name' => __('API Key', 'wp-sms'), 'desc' => __('Enter your API KEY', 'wp-sms')]];
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
            if (empty($this->gateway_key)) {
                return new WP_Error('account-credit', 'API Key is not set');
            }
            $message = $this->getTemplateIdAndMessageBody();
            $args = ['headers' => 'application/x-www-form-urlencoded'];
            $this->to = Helper::removeNumbersPrefix(['+86'], $this->to);
            $params = ['key' => $this->gateway_key, 'mobile' => $this->to[0], 'tpl_id' => $message['template_id'], 'tpl_value' => \urlencode($message['message'])];
            $response = $this->request('GET', $this->wsdl_link, $params, $args, \false);
            if ($response->error_code != 0) {
                throw new Exception($response->reason);
            }
            $this->log($this->from, $this->msg, $this->to, $response);
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             *
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $response);
            return $response;
        } catch (Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        try {
            if (empty($this->gateway_key)) {
                return new WP_Error('account-credit', 'API Key is not set.');
            }
            return 'Unable to check balance!';
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

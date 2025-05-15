<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
use WP_SMS\Helper;
/**
 * Class Semaphore
 *
 * Website: https://semaphore.co
 * API Documentation: https://semaphore.co/docs
 *
 * @package WP_SMS\Gateway
 */
class semaphore extends Gateway
{
    private $wsdl_link = "https://api.semaphore.co/api/v4/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $key;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
        $this->gatewayFields = ['key' => ['id' => 'key', 'name' => __('API Key', 'wp-sms'), 'desc' => __('Enter your API KEY', 'wp-sms')], 'from' => ['id' => 'from', 'name' => __('Sender', 'wp-sms'), 'desc' => __('Enter Sender Name', 'wp-sms'), 'default' => 'SEMAPHORE']];
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
            if (!$this->key) {
                return new WP_Error('account-credit', __('The API Key for this gateway is not set', 'wp-sms-pro'));
            }
            $this->to = Helper::removeNumbersPrefix(['+'], $this->to);
            $arguments = array('apikey' => $this->key, 'number' => \implode(',', $this->to), 'message' => \urlencode($this->msg), 'sendername' => $this->from);
            $response = $this->request('POST', $this->wsdl_link . 'messages', $arguments);
            if (isset($response->error)) {
                throw new Exception($response->error);
            }
            if (isset($response->apikey)) {
                throw new Exception($response->apikey[0]);
            }
            if (!isset($response[0]->message_id)) {
                throw new Exception(\json_encode($response));
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
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        if (!$this->key) {
            return new WP_Error('account-credit', __('The API Key for this gateway is not set', 'wp-sms-pro'));
        }
        $arguments = array('apikey' => $this->key);
        $response = $this->request('GET', $this->wsdl_link . 'account', $arguments, [], \false);
        if (isset($response->error)) {
            return new WP_Error('account-credit', $response->error, 'wp-sms-pro');
        }
        if (!isset($response->account_id)) {
            return new WP_Error('account-credit', $response, 'wp-sms-pro');
        }
        return $response->credit_balance;
    }
}

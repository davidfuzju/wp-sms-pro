<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
class esmsbd extends Gateway
{
    private $wsdl_link = 'https://login.esms.com.bd/api/v3';
    public $tariff = 'https://esms.com.bd';
    public $unitrial = \false;
    public $flash = "disable";
    public $isflash = \false;
    public $unit;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->validateNumber = esc_html__('e.g. 880xxxxxxxxxx', 'wp-sms-pro');
        $this->has_key = \true;
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => esc_html__('API Key', 'wp-sms'), 'desc' => esc_html__('Enter API key of gateway.', 'wp-sms')], 'from' => ['id' => 'gateway_sender_id', 'name' => esc_html__('Approved Sender ID', 'wp-sms'), 'desc' => esc_html__('Enter sender ID of gateway.', 'wp-sms')]];
    }
    public function SendSMS()
    {
        /**
         * Modify sender number
         *
         * @param string $this ->from sender number.
         * @since 3.4
         *
         */
        $this->from = apply_filters('wp_sms_from', $this->from);
        /**
         * Modify Receiver number
         *
         * @param array $this ->to receiver number
         * @since 3.4
         *
         */
        $this->to = apply_filters('wp_sms_to', $this->to);
        /**
         * Modify text message
         *
         * @param string $this ->msg text message.
         * @since 3.4
         *
         */
        $this->msg = apply_filters('wp_sms_msg', $this->msg);
        try {
            $params = ['headers' => ['Authorization' => 'Bearer ' . $this->has_key, 'Accept' => 'application/json']];
            $args = ['type' => 'plain', 'recipient' => \implode(',', $this->to), 'sender_id' => $this->from, 'message' => $this->msg];
            $response = $this->request('POST', "{$this->wsdl_link}/sms/send", $args, $params, \false);
            if ($response->status != 'success') {
                throw new Exception($response->message);
            }
            //log the result
            $this->log($this->from, $this->msg, $this->to, $response);
            /**
             * Run hook after send sms.
             *
             * @param string $response result output.
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
            if (!$this->has_key) {
                throw new Exception(esc_html__('The API Key for this gateway is not set.', 'wp-sms-pro'));
            }
            $params = ['headers' => ['Authorization' => 'Bearer ' . $this->has_key]];
            $response = $this->request('GET', "{$this->wsdl_link}/balance", [], $params, \false);
            if ($response->status != 'success') {
                throw new Exception($response->message);
            }
            return $response->data->remaining_unit;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

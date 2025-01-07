<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class bulksmsMa extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://bulksms.ma/developer";
    public $tariff = "https://www.bulksms.ma";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->bulk_send = \true;
        $this->validateNumber = "Numbers must be in Moroccan format 06/7XXXXXXXX, separated by commas.";
        $this->help = "";
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'API key available on your manager.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Message Sender', 'desc' => '[Optional] Message sender (if the operator allows it), 3 to 11 alphanumeric characters (a-zA-Z). If the key to use is for sending by ALIAS.']];
    }
    public function SendSMS()
    {
        /**
         * Modify sender number
         *
         * @param string $this ->from sender number.
         *
         * @since 3.4
         *
         */
        $this->from = apply_filters('wp_sms_from', $this->from);
        /**
         * Modify Receiver number
         *
         * @param array $this ->to receiver number
         *
         * @since 3.4
         *
         */
        $this->to = apply_filters('wp_sms_to', $this->to);
        /**
         * Modify text message
         *
         * @param string $this ->msg text message.
         *
         * @since 3.4
         *
         */
        $this->msg = apply_filters('wp_sms_msg', $this->msg);
        try {
            $params = ['token' => $this->has_key, 'tel' => \implode(',', $this->to), 'message' => $this->msg, 'shortcode' => isset($this->from) ? $this->from : null];
            $response = $this->request('GET', "{$this->wsdl_link}/sms/send", $params, []);
            if (isset($response->error)) {
                throw new Exception($response->error);
            }
            // Log the result
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
            // Check API key
            if (!$this->has_key) {
                return new WP_Error('account-credit', __('The API Key is required.', 'wp-sms-pro'));
            }
            $params = ['token' => $this->has_key];
            $response = $this->request('GET', "{$this->wsdl_link}/account/solde", $params, []);
            if (isset($response->error)) {
                throw new Exception($response->error);
            }
            return $response->solde;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class smspoh extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://smspoh.com/api";
    public $tariff = "https://smspoh.com";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->has_key = \true;
        $this->validateNumber = "";
        $this->help = "You can find your app authorization key under your profile account.";
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => 'Authorization Key', 'desc' => 'Enter your authorization key.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender number', 'desc' => 'Sender number or sender ID']];
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
            $arguments = ['headers' => ['Authorization' => "Bearer {$this->has_key}"], 'body' => \json_encode(['to' => $this->to, 'message' => $this->msg, 'sender' => $this->from])];
            $response = $this->request('POST', "{$this->wsdl_link}/v2/send", [], $arguments, \false);
            if (isset($response->status) && $response->status !== \true) {
                throw new Exception($response->error->name . ': ' . $response->error->messages[0]);
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
            // Check username and password
            if (!$this->has_key) {
                throw new Exception(__('The authorization key for this gateway is not set.', 'wp-sms-pro'));
            }
            $response = $this->request('GET', "{$this->wsdl_link}/v2/get-balance", [], ['headers' => ['Authorization' => "Bearer {$this->has_key}"]], \false);
            if (isset($response->status) && $response->status !== \true) {
                throw new Exception($response->error->name . ': ' . $response->error->messages[0]);
            }
            return $response->data->credits;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

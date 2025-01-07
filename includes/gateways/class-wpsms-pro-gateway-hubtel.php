<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class hubtel extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://devp-sms03726-api.hubtel.com/v1";
    public $tariff = "https://hubtel.com";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \false;
        $this->bulk_send = \true;
        $this->validateNumber = "";
        $this->help = "";
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'ClientID', 'desc' => 'Enter your ClientID.'], 'password' => ['id' => 'gateway_password', 'name' => 'Client Secret', 'desc' => 'Enter your Client Secret.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender ID', 'desc' => 'Must be 11 alpha-numeric characters or less; subject to approval by Hubtel.']];
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
            $responseArray = [];
            foreach ($this->to as $to) {
                $arguments = ['headers' => ['Content-Type' => 'application/json', 'Authorization' => "Basic " . \base64_encode("{$this->username}:{$this->password}")], 'body' => ['from' => $this->from, 'to' => $to, 'content' => $this->msg]];
                $response = $this->request('POST', "{$this->wsdl_link}/messages/send", [], $arguments);
                // Error Handler
                if (isset($response->responseCode) && $response->responseCode !== '201') {
                    throw new Exception($response->message);
                }
                // Log the result
                $this->log($this->from, $this->msg, $this->to, $response);
                $responseArray[] = $response;
            }
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             *
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $responseArray);
            return $responseArray;
        } catch (Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        try {
            // Check username and password
            if (!$this->username or !$this->password) {
                return new WP_Error('account-credit', __('ClientID and Client Secret are required.', 'wp-sms-pro'));
            }
            return \true;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

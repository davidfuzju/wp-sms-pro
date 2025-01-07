<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class smscountry extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://restapi.smscountry.com/v0.1/Accounts";
    public $tariff = "https://www.smscountry.com";
    public $unitrial = \false;
    public $unit;
    public $flash = "disabled";
    public $isflash = \false;
    public $auth_key = '';
    public $auth_token = '';
    public function __construct()
    {
        parent::__construct();
        $this->validateNumber = "";
        $this->gatewayFields = ['auth_key' => ['id' => 'auth_key', 'name' => 'Auth Key', 'desc' => 'Enter your Auth Key.'], 'auth_token' => ['id' => 'auth_token', 'name' => 'Auth Token', 'desc' => 'Enter your Auth Token.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender ID', 'desc' => 'Enter sender ID of gateway.']];
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
            $arguments = ['headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Basic ' . \base64_encode($this->auth_key . ':' . $this->auth_token)], 'body' => ["Text" => $this->msg, "SenderId" => $this->from]];
            if (\count($this->to) > 1) {
                $apiUrl = "{$this->wsdl_link}/{$this->auth_key}/BulkSMSes/";
                $arguments['body']['Numbers'] = $this->cleanNumbers($this->to);
            } else {
                $apiUrl = "{$this->wsdl_link}/{$this->auth_key}/SMSes/";
                $arguments['body']['Number'] = $this->cleanNumbers($this->to);
            }
            $arguments['body'] = \json_encode($arguments['body']);
            $response = $this->request('POST', $apiUrl, [], $arguments);
            if (isset($response->Success) && $response->Success !== 'True') {
                throw new Exception($response->Message);
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
            if (!$this->auth_key && !$this->auth_token) {
                return new WP_Error('Auth key and Auth token are required.');
            }
            return 1;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
use WP_SMS\Helper;
class smsnoc extends Gateway
{
    private $wsdl_link = "https://app.smsnoc.com/api/v3/";
    public $tariff = "https://smsnoc.com/";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public $type;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->bulk_send = \true;
        $this->validateNumber = "";
        $this->help = "";
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'Enter your API key.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender ID', 'desc' => 'Enter the sender id.'], 'type' => ['id' => 'gateway_type', 'name' => 'Type', 'desc' => 'Select the message type.', 'type' => 'select', 'options' => ['plain' => 'Plain', 'whatsapp' => 'Whatsapp']]];
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
            $this->to = Helper::removeNumbersPrefix(['+'], $this->to);
            $recipients = \implode(',', $this->to);
            $params = ['headers' => ['Authorization' => "Bearer {$this->has_key}", 'Content-Type' => 'application/json', 'Accept' => 'application/json'], 'body' => \json_encode(['message' => $this->msg, 'sender_id' => $this->from, 'type' => $this->type, 'recipient' => $recipients])];
            $response = $this->request('POST', $this->wsdl_link . 'sms/send', [], $params, \false);
            // todo improve error handler
            if ($response->status != 'success') {
                $errorMessage = $response->message ? $response->message : __('Something went wrong', 'wp-sms-pro');
                throw new Exception($errorMessage);
            }
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
            if (empty($this->has_key)) {
                return new WP_Error('account-credit', 'The API Key is required!');
            }
            $params = ['headers' => ['Authorization' => "Bearer {$this->has_key}", 'Content-Type' => 'application/json', 'Accept' => 'application/json']];
            $response = $this->request('GET', $this->wsdl_link . 'balance', [], $params);
            if ($response->status != 'success') {
                $errorMessage = $response->message ? $response->message : __('Something went wrong', 'wp-sms-pro');
                throw new Exception($errorMessage);
            }
            return $response->data->remaining_balance;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

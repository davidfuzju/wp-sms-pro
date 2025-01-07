<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
class clickatell extends Gateway
{
    private $wsdl_link = "https://platform.clickatell.com/";
    public $tariff = "http://www.clickatell.com/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $gateway_key;
    public $gateway_route = 'sms';
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->help = "For bulk send, set Delivery Method to Batch SMS Queue.";
        $this->supportIncoming = \true;
        $this->gatewayFields = ['gateway_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'Please enter your API key.'], 'from' => ['id' => 'from', 'name' => 'From', 'desc' => 'The two-way number that will be used for message delivery'], 'gateway_route' => ['id' => 'gateway_route', 'name' => 'Route', 'desc' => 'Please select channel route.', 'type' => 'select', 'options' => ['sms' => 'SMS', 'whatsapp' => 'Whatsapp']]];
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
            $credits = $this->GetCredit();
            if (is_wp_error($credits)) {
                throw new Exception($credits->get_error_message());
            }
            $messages = [];
            foreach ($this->to as $recipient) {
                $messages[] = ['channel' => $this->gateway_route, 'to' => $recipient, 'content' => $this->msg, 'from' => $this->from];
            }
            $params = ['headers' => ['Accept' => 'application/json', 'Authorization' => $this->gateway_key, 'Content-Type' => 'application/json'], 'body' => \json_encode(['messages' => $messages])];
            $response = $this->request('POST', $this->wsdl_link . 'v1/message', [], $params, \false);
            if (isset($response->error)) {
                throw new Exception($response->error);
            }
            $success = $failed = [];
            foreach ($response->messages as $message) {
                if ($message->accepted == \true) {
                    $success[$message->to] = $message;
                } else {
                    $failed[$message->to] = $message;
                }
            }
            if (\count($success) > 0) {
                $this->log($this->from, $this->msg, \array_keys($success), $success);
            }
            if (\count($failed) > 0) {
                $this->log($this->from, $this->msg, \array_keys($failed), $failed, 'error');
            }
            if ($failed) {
                return new WP_Error('send-sms', 'The SMS did not send for this number(s): ' . \implode('<br/>', \array_keys($failed)) . ' See the response on Outbox.');
            }
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
                return new WP_Error('account-credit', 'Please enter your API key.');
            }
            $params = ['headers' => ['Accept' => 'application/json', 'Authorization' => $this->gateway_key, 'Content-Type' => 'application/json']];
            $response = $this->request('GET', $this->wsdl_link . 'v1/balance', [], $params, \false);
            if (!isset($response->balance)) {
                throw new Exception($response->error);
            }
            return $response->balance;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

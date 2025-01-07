<?php

namespace WP_SMS\Gateway;

use Exception;
class apifon extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://ars.apifon.com";
    public $tariff = "https://www.apifon.com";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->bulk_send = \true;
        $this->validateNumber = "";
        $this->help = "";
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'Enter your API key.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender ID', 'desc' => 'Enter the sender id.']];
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
            $recipients = [];
            foreach ($this->to as $recipient) {
                $recipients[] = ['number' => $recipient];
            }
            $arguments = ['headers' => ['Authorization' => "ApifonWS {$this->has_key}"], 'body' => \json_encode(['text' => ['text' => $this->msg, 'sender_id' => $this->from], 'subscribers' => $recipients])];
            $response = $this->request('POST', "{$this->wsdl_link}/services/api/v1/sms/send", [], $arguments);
            // todo improve error handler
            if (!isset($response)) {
                throw new Exception(__('Something went wrong', 'wp-sms-pro'));
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
        } catch (\Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new \WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        try {
            // Check username and password
            if (!$this->has_key) {
                throw new \Exception(__('The API Key is required.', 'wp-sms-pro'));
            }
            $arguments = ['headers' => ['Authorization' => "Bearer {$this->has_key}"]];
            $response = $this->request('POST', "{$this->wsdl_link}/services/api/v1/balance", [], $arguments);
            return $response;
        } catch (\Exception $e) {
            return new \WP_Error('get-credit', $e->getMessage());
        }
    }
}

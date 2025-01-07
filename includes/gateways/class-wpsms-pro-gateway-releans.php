<?php

namespace WP_SMS\Gateway;

use Exception;
class releans extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api.releans.com/v2";
    public $tariff = "https://releans.com/";
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
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'Enter your API key'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender ID', 'desc' => 'Enter the sender id']];
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
            $recipients = \implode(", ", $this->to);
            $arguments = ['headers' => array('Authorization' => "Bearer {$this->has_key}"), 'body' => ['mobile' => $recipients, 'content' => $this->msg, 'sender' => $this->from]];
            $response = $this->request('POST', "{$this->wsdl_link}/batch", [], $arguments);
            // todo improve error handler
            if ($response->status !== 201 || $response->code !== 77) {
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
            $params = ['headers' => ['Authorization' => "Bearer {$this->has_key}"]];
            $response = $this->request('GET', "{$this->wsdl_link}/balance", [], $params);
            $credit = $response->balance . ' USD';
            return $credit;
        } catch (\Exception $e) {
            return new \WP_Error('get-credit', $e->getMessage());
        }
    }
}

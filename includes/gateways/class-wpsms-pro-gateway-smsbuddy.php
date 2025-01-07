<?php

namespace WP_SMS\Gateway;

use Exception;
class smsbuddy extends \WP_SMS\Gateway
{
    private $wsdl_link = "http://thesmsbuddy.com/api";
    public $tariff = "https://thesmsbuddy.com/";
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
        $this->template_id = "";
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'Enter your API key.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender', 'desc' => 'Enter the sender id.'], 'template_id' => ['id' => 'gateway_template_id', 'name' => 'Template ID', 'desc' => 'Enter the sender id.']];
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
            $recipients = \implode(',', $this->to);
            $params = ['key' => $this->has_key, 'type' => 1, 'to' => $recipients, 'sender' => $this->from, 'message' => $this->msg, 'flash' => $this->isflash, 'template_id' => $this->template_id];
            $options = [\CURLOPT_TIMEOUT => 10];
            $response = $this->request('GET', "{$this->wsdl_link}/v1/sms/send", $params, $options);
            // todo improve error handler
            if (!isset($response)) {
                throw new Exception(__('Something went wrong', 'wp-sms-pro'));
            }
            //log the result
            $this->log($this->from, $this->msg, $this->to, $response->message);
            /**
             * Run hook after send sms.
             *
             * @param string $response result output.
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $response->message);
            return $response;
        } catch (\Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new \WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        try {
            // Check API Key
            if (!$this->has_key) {
                throw new \Exception(__('The API Key is required.', 'wp-sms-pro'));
            }
            $params = ['key' => $this->has_key];
            $response = $this->request('GET', "{$this->wsdl_link}/sms/balance/check", $params, []);
            $credit = $response->data->trans;
            return $credit;
        } catch (\Exception $e) {
            return new \WP_Error('get-credit', $e->getMessage());
        }
    }
}

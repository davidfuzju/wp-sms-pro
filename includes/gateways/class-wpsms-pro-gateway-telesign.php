<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
use WP_SMS\Helper;
class telesign extends Gateway
{
    private $wsdl_link = "https://rest-ww.telesign.com/v1/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $customerid;
    public $apikey;
    public $from;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
        $this->validateNumber = 'Mobile Number With Country Code';
        $this->help = "The end user's phone number with country code included.";
        $this->gatewayFields = ['customerid' => ['id' => 'customerid', 'name' => __('Customer Id', 'wp-sms'), 'desc' => __('Enter your Customer ID', 'wp-sms')], 'apikey' => ['id' => 'apikey', 'name' => __('API Key', 'wp-sms'), 'desc' => __('Enter your API Key', 'wp-sms')], 'from' => ['id' => 'from', 'name' => __('Sender', 'wp-sms'), 'desc' => __('Enter your Sender Id', 'wp-sms')]];
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
            $this->to = Helper::removeNumbersPrefix(['+'], $this->to);
            $authorization = \base64_encode($this->customerid . ':' . $this->apikey);
            $recipientCount = \count($this->to);
            if ($recipientCount === 1) {
                $recipients = $this->to[0];
                $params = ['headers' => ['Authorization' => 'Basic ' . $authorization, 'Content-Type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json'], 'body' => ['message' => $this->msg, 'message_type' => 'ARN', 'phone_number' => $recipients, 'sender_id' => $this->from]];
                $response = $this->request('POST', $this->wsdl_link . 'messaging', [], $params, \false);
            } else {
                $recipients = \str_replace(' ', '', \implode(',', $this->to));
                $params = ['headers' => ['Authorization' => 'Basic ' . $authorization, 'Content-Type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json'], 'body' => ['template' => $this->msg, 'recipients' => $recipients, 'sender_id' => $this->from]];
                $response = $this->request('POST', $this->wsdl_link . 'verify/bulk_sms', [], $params, \false);
            }
            if ($response->status->code != 200) {
                throw new Exception($response->status->description);
            }
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
            if (empty($this->customerid) || empty($this->apikey)) {
                return new WP_Error('account-credit', 'Please enter your Customer ID and API Key');
            }
            return 'Unable to check balance!';
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

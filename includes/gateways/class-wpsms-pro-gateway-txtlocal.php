<?php

namespace WP_SMS\Gateway;

class txtlocal extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api.txtlocal.com/";
    public $tariff = "https://www.txtlocal.com/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->bulk_send = \true;
        $this->validateNumber = "e.g. 447xxxxxxxxx";
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
        // Get the credit.
        $credit = $this->GetCredit();
        // Check gateway credit
        if (is_wp_error($credit)) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $credit->get_error_message(), 'error');
            return $credit;
        }
        $to = \implode(',', $this->to);
        $to = \urlencode($to);
        $text = \rawurlencode($this->msg);
        $this->from = \urlencode($this->from);
        $response = wp_remote_get($this->wsdl_link . "send/?apikey=" . $this->has_key . "&sender=" . $this->from . "&message=" . $text . "&numbers=" . $to);
        // Check gateway credit
        if (is_wp_error($response)) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $response->get_error_message(), 'error');
            return new \WP_Error('send-sms', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code == '200') {
            $result = \json_decode($response['body']);
            if (isset($result->result->errors)) {
                // Log the result
                $this->log($this->from, $this->msg, $this->to, $result->result->errors, 'error');
                return new \WP_Error('send-sms', $result->result->error);
            }
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $result);
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $result);
            return $result;
        } else {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $response['body'], 'error');
            return new \WP_Error('send-sms', $response['body']);
        }
    }
    public function GetCredit()
    {
        // Check api key
        if (!$this->has_key) {
            return new \WP_Error('account-credit', __('The API Key for this gateway is not set', 'wp-sms-pro'));
        }
        $response = wp_remote_get($this->wsdl_link . "balance/?apikey={$this->has_key}");
        // Check gateway credit
        if (is_wp_error($response)) {
            return new \WP_Error('account-credit', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code == '200') {
            $result = \json_decode($response['body'], \true);
            if (isset($result['errors'])) {
                return new \WP_Error('account-credit', $result['errors'][0]['message']);
            } else {
                return $result['balance']['sms'];
            }
        } else {
            return new \WP_Error('account-credit', $response['body']);
        }
    }
}

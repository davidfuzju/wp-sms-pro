<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
/**
 * Class bulksmsgateway
 *
 * Website: https://www.bulksmsgateway.in/
 * API Documentation: https://www.bulksmsgateway.in/php
 *
 * @package WP_SMS\Gateway
 */
class bulksmsgateway extends Gateway
{
    private $wsdl_link = "https://%s.bulksmsgateway.in/";
    public $tariff = "https://bulksmsgateway.in/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \false;
        $this->bulk_send = \true;
        $this->validateNumber = esc_html__('Enter number without country code.', 'wp-sms');
        $this->help = __('For send messages, send variables and message id in this format: <b>message|template_id</b>', 'wp-sms');
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
            // Get the credit.
            $credit = $this->GetCredit();
            // Check gateway credit
            if (is_wp_error($credit)) {
                // Log the result
                $this->log($this->from, $this->msg, $this->to, $credit->get_error_message(), 'error');
                return $credit;
            }
            $this->wsdl_link = \sprintf($this->wsdl_link, 'api');
            $message = $this->getTemplateIdAndMessageBody();
            $arguments = ['user' => $this->username, 'password' => $this->password, 'mobile' => \implode(',', $this->to), 'message' => $message['message'], 'sender' => $this->from, 'type' => '3', 'template_id' => $message['template_id']];
            $response = $this->request('POST', $this->wsdl_link . 'sendmessage.php', $arguments);
            if (isset($response->error)) {
                throw new Exception($response->error);
            }
            if (!isset($response->status)) {
                throw new Exception('Invalid response!');
            }
            if ($response->status != 'success') {
                throw new Exception($response->response);
            }
            // Log the result
            $this->log($this->from, $message['message'], $this->to, $response);
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
        // Check username and password
        if (!$this->username && !$this->password) {
            return new WP_Error('account-credit', __('The username/password for this gateway is not set', 'wp-sms'));
        }
        $this->wsdl_link = \sprintf($this->wsdl_link, 'login');
        try {
            $response = $this->request('GET', $this->wsdl_link . 'userbalance.php', ['user' => $this->username, 'password' => $this->password, 'type' => '3']);
            if (isset($response->status)) {
                throw new Exception($response->status);
            }
            if (!isset($response->remainingcredits)) {
                throw new Exception('Invalid response');
            }
            return $response->remainingcredits;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

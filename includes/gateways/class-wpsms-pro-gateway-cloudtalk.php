<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
use WP_SMS\Helper;
class cloudtalk extends Gateway
{
    private $wsdl_link = "https://my.cloudtalk.io/api/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $gateway_access_key_id;
    public $gateway_access_key_secret;
    public $route = 'sms';
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \false;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
        $this->help = "To get your API Keys, please refer to in the Cloudtalk Dashboard under Account → Settings → API Keys tab.";
        $this->validateNumber = "Mobile number with country code, e.g. +421XXXXXXXXX";
        $this->gatewayFields = ['gateway_access_key_id' => ['id' => 'gateway_access_key_id', 'name' => __('Access key ID', 'wp-sms'), 'desc' => __('Enter your Access key ID', 'wp-sms')], 'gateway_access_key_secret' => ['id' => 'gateway_access_key_secret', 'name' => __('Access key Secret', 'wp-sms'), 'desc' => __('Enter your Access key Secret', 'wp-sms')], 'from' => ['id' => 'from', 'name' => __('Sender number', 'wp-sms'), 'desc' => __('Enter your Sender number/name', 'wp-sms')], 'route' => ['id' => 'route', 'name' => __('Route', 'wp-sms'), 'desc' => __('Please select route.', 'wp-sms'), 'type' => 'select', 'options' => ['sms' => __('SMS', 'wp-sms'), 'whatsapp' => __('WhatsApp', 'wp-sms')]]];
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
            // Check the completion of the fields
            $credits = $this->GetCredit();
            if (is_wp_error($credits)) {
                throw new Exception($credits->get_error_message());
            }
            $recipientNumber = $this->to[0];
            $senderNumber = $this->from;
            if ($this->route === 'whatsapp') {
                $recipientNumber = 'whatsapp:' . $recipientNumber;
                $senderNumber = 'whatsapp:' . $senderNumber;
            }
            $data = ['recipient' => $recipientNumber, 'message' => $this->msg, 'sender' => $senderNumber];
            $ch = \curl_init($this->wsdl_link . 'sms/send.json');
            \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, \true);
            \curl_setopt($ch, \CURLOPT_HTTPAUTH, \CURLAUTH_BASIC);
            \curl_setopt($ch, \CURLOPT_USERPWD, "{$this->gateway_access_key_id}:{$this->gateway_access_key_secret}");
            \curl_setopt($ch, \CURLOPT_POST, \true);
            \curl_setopt($ch, \CURLOPT_POSTFIELDS, \json_encode($data));
            \curl_setopt($ch, \CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = \curl_exec($ch);
            $responseCode = \curl_getinfo($ch, \CURLINFO_HTTP_CODE);
            if (\curl_errno($ch)) {
                throw new Exception(\curl_error($ch));
            }
            if ($responseCode != 200) {
                throw new Exception($response);
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
            if (empty($this->gateway_access_key_id) || empty($this->gateway_access_key_secret) || empty($this->from)) {
                return new WP_Error('account-credit', 'Please enter your Cloudtalk Access key ID, Access key Secret and Sender.');
            }
            return 'Cloudtalk does not provide credit balance.';
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

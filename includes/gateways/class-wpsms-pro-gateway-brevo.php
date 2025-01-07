<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
use WP_SMS\Helper;
class brevo extends Gateway
{
    private $wsdl_link = "https://api.brevo.com/v3/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $gateway_key;
    public $gateway_sms_type = 'transactional';
    public $route = 'sms';
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \false;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
        $this->help = "To get your API Key, please visit <a href='https://app.brevo.com/settings/keys/api' target='_blank'>this link</a> in your Brevo user panel.";
        $this->validateNumber = "Mobile number to send SMS with the country code";
        $this->gatewayFields = ['gateway_key' => ['id' => 'gateway_key', 'name' => __('API Key', 'wp-sms'), 'desc' => __('Enter your API KEY', 'wp-sms')], 'from' => ['id' => 'gateway_sender_id', 'name' => __('Sender number', 'wp-sms'), 'desc' => __('Enter your Sender number/name', 'wp-sms')], 'gateway_sms_type' => ['id' => 'gateway_sms_type', 'name' => __('Type', 'wp-sms'), 'desc' => __('Please select type of the SMS.', 'wp-sms'), 'type' => 'select', 'options' => ['transactional' => __('Transactional', 'wp-sms'), 'marketing' => __('Marketing', 'wp-sms')]], 'route' => ['id' => 'route', 'name' => __('Route', 'wp-sms'), 'desc' => __('Please select route.', 'wp-sms'), 'type' => 'select', 'options' => ['sms' => __('SMS', 'wp-sms'), 'whatsapp' => __('WhatsApp', 'wp-sms')]]];
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
            if (empty($this->gateway_key)) {
                return new WP_Error('account-credit', 'API Key is not set');
            }
            $this->to = Helper::removeNumbersPrefix(['+'], $this->to);
            $paramsData = $this->createMessageParams($this->route == 'whatsapp');
            $params = ['headers' => ['accept' => 'application/json', 'api-key' => $this->gateway_key, 'content-type' => 'application/json'], 'body' => wp_json_encode($paramsData['messages'])];
            $response = $this->request('POST', $this->wsdl_link . $paramsData['endpoint'], [], $params);
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
            if (empty($this->gateway_key)) {
                return new WP_Error('account-credit', 'API Key is not set.');
            }
            $params = array('headers' => array('accept' => 'application/json', 'api-key' => $this->gateway_key));
            $response = $this->request('GET', $this->wsdl_link . 'account', [], $params);
            $smsPlan = \array_filter($response->plan, function ($plan) {
                return $plan->type === 'sms';
            });
            $smsCredits = !empty($smsPlan) ? \reset($smsPlan)->credits : null;
            if ($smsCredits !== null) {
                return "Credits for SMS: " . $smsCredits;
            }
            return "SMS credits not found.";
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
    // Function to create message and parameters
    private function createMessageParams($isWhatsApp)
    {
        if ($isWhatsApp) {
            return ['messages' => ['senderNumber' => $this->from, 'contactNumbers' => $this->to[0], 'text' => $this->msg], 'endpoint' => 'whatsapp/sendMessage'];
        } else {
            return ['messages' => ['sender' => $this->from, 'recipient' => $this->to[0], 'content' => $this->msg, 'type' => $this->gateway_sms_type], 'endpoint' => 'transactionalSMS/sms'];
        }
    }
}

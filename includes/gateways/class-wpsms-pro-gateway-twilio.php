<?php

namespace WP_SMS\Gateway;

use Exception;
use WPSmsPro\Vendor\Twilio\Rest\Client;
use WP_Error;
class twilio extends \WP_SMS\Gateway
{
    public $tariff = "http://twilio.com/";
    public $unitrial = \true;
    public $unit;
    public $flash = "enable";
    public $isflash = \false;
    public $supportMedia = \true;
    public $supportIncoming = \true;
    public $documentUrl = 'https://wp-sms-pro.com/resources/twilio-gateway-configuration/';
    public $subaccount_sid;
    public $route = 'sms';
    /**
     * @var Client
     */
    private $client;
    /**
     * twilio constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->validateNumber = "The destination phone number. Format with a '+' and country code e.g., +16175551212 (E.164 format).";
        $this->has_key = \true;
        $this->help = __('For WhatsApp messages, please make sure you have a WhatsApp enabled Twilio account. <a href="https://www.twilio.com/docs/whatsapp/api" target="_blank">Click here</a> to learn more.', 'wp-sms');
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'Account SID', 'desc' => 'Enter your Account SID'], 'password' => ['id' => 'gateway_password', 'name' => 'Auth Token', 'desc' => 'Enter your Auth Token'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender number', 'desc' => 'Sender number or sender ID'], 'subaccount_sid' => ['id' => 'subaccount_sid', 'name' => 'Sub-account SID', 'desc' => "If you’d like to send SMS through a Sub-Account, please enter the Sub-account SID, otherwise leave it blank."], 'route' => ['id' => 'route', 'name' => esc_html__('Route', 'wp-sms'), 'desc' => esc_html__('Please select SMS route.', 'wp-sms'), 'type' => 'select', 'options' => ["sms" => esc_html__('SMS', 'wp-sms'), 'whatsapp' => esc_html__('WhatsApp', 'wp-sms')]]];
    }
    public function SendSMS()
    {
        /**
         * Modify sender number
         *
         * @param string $this- >from sender number.
         *
         * @since 3.4
         *
         */
        $this->from = apply_filters('wp_sms_from', $this->from);
        /**
         * Modify Receiver number
         *
         * @param array $this- >to receiver number
         *
         * @since 3.4
         *
         */
        $this->to = apply_filters('wp_sms_to', $this->to);
        /**
         * Modify text message
         *
         * @param string $this- >msg text message.
         *
         * @since 3.4
         *
         */
        $this->msg = apply_filters('wp_sms_msg', $this->msg);
        try {
            $this->client = new Client($this->username, $this->password, $this->subaccount_sid);
            $result = $this->sendTwilioMessage();
            $this->log($this->from, $this->msg, $this->to, $result, 'success', $this->media);
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             *
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $result);
            return $result;
        } catch (Exception $e) {
            // Todo, need to be improvement.
            if ($this->has_key && $this->has_key != 1) {
                $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error', $this->media);
            }
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    private function sendTwilioMessage()
    {
        $result = [];
        $errors = [];
        foreach ($this->to as $number) {
            if ($this->route == 'whatsapp') {
                $number = 'whatsapp:' . $number;
            }
            $requestBody = apply_filters('wp_sms_twilio_request_body', ['from' => $this->from, 'body' => $this->msg, 'mediaUrl' => $this->media], $number);
            try {
                $request = $this->client->messages->create($number, $requestBody);
                if ($request->to) {
                    $result[$number]['to'] = $request->to;
                }
                if ($request->status) {
                    $result[$number]['status'] = $request->status;
                }
                if ($request->errorMessage) {
                    $result[$number]['errorMessage'] = $request->errorMessage;
                    $errors[] = $number . ':' . $request->errorMessage;
                }
            } catch (Exception $e) {
                $errors[$number] = ['message_content' => $requestBody['body'], 'error_response' => $e->getMessage()];
            }
        }
        if ($errors) {
            $this->log($this->from, $this->msg, $this->to, $errors, 'error', $this->media);
            throw new Exception('The SMS did not send for this number(s): ' . \implode('<br/>', \array_keys($errors)) . ' See the response on Outbox.');
        }
        return $result;
    }
    public function GetCredit()
    {
        // Check username and password
        if (!$this->username or !$this->password) {
            return new WP_Error('account-credit', __('The username/password for this gateway is not set', 'wp-sms-pro'));
        }
        if (!\function_exists('curl_version')) {
            return new WP_Error('required-function', __('CURL extension not found in your server. please enable curl extension.', 'wp-sms'));
        }
        try {
            if (!\class_exists('WPSmsPro\\Vendor\\Twilio\\Rest\\Client')) {
                throw new Exception('Class Twilio\\Rest\\Client not found, make sure WP SMS Pro is installed.');
            }
            $this->client = new Client($this->username, $this->password);
            $balance = $this->client->balance->fetch();
            return $balance->currency . ' ' . $balance->balance;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

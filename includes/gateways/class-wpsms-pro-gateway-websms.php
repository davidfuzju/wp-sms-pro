<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class websms extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api.websms.com/rest";
    public $tariff = "http://www.websms.at";
    public $unitrial = \false;
    public $unit;
    public $flash = "enable";
    public $isflash = \false;
    public $sernder_address_type = '';
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->bulk_send = \true;
        $this->validateNumber = "4367612345678";
        $this->help = "API Key may be created inside the onlinesms web interface.";
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'Enter your gateway API key. '], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender Address', 'desc' => 'Enter your sender address.'], 'sernder_address_type' => ['id' => 'sernder_address_type', 'name' => 'Sender Address Type', 'type' => 'select', 'desc' => '', 'options' => ['national' => 'National', 'international' => 'International', 'alphanumeric' => 'Alphanumeric', 'shortcode' => 'Shortcode']]];
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
            $body = ['recipientAddressList' => $this->to, 'messageContent' => $this->msg, 'sendAsFlashSms' => (bool) $this->isflash];
            if ($this->from) {
                $body['senderAddress'] = $this->from;
                $body['SenderAddressType'] = $this->sernder_address_type;
            }
            $arguments = ['headers' => ['Authorization' => "Bearer {$this->has_key}", 'Accept' => 'application/json', 'Content-Type' => 'application/json;charset=UTF-8'], 'body' => \json_encode($body)];
            $response = $this->request('POST', "{$this->wsdl_link}/smsmessaging/text", [], $arguments);
            if (isset($response->statusCode) && ($response->statusCode == '2000' or $response->statusCode == '2001')) {
                // Log the result
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
            }
            throw new Exception($response->statusMessage);
        } catch (Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        // Check username and password
        if (!$this->has_key) {
            return new WP_Error('account-credit', __('The API key is required.', 'wp-sms-pro'));
        }
        return 1;
    }
}

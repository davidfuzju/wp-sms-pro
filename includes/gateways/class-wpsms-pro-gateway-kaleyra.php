<?php

namespace WP_SMS\Gateway;

use Exception;
use WPSmsPro\Vendor\ParagonIE\Sodium\Core\Curve25519\Ge\P1p1;
class kaleyra extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api.kaleyra.io/v1";
    public $tariff = "https://www.kaleyra.com";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public $sid_key = '';
    public $template_id = '';
    public $route_type = '';
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->bulk_send = \true;
        $this->validateNumber = "e.g. +41780000000, +4170000001";
        $this->gatewayFields = ['from' => ['id' => 'gateway_sender_id', 'name' => 'Sender number', 'desc' => 'Sender number or sender ID'], 'has_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'Enter your API Key'], 'sid_key' => ['id' => 'sid_key', 'name' => 'API SID', 'desc' => 'Enter your SID (Security Identifier)'], 'route_type' => ['id' => 'route_type', 'name' => 'Type of route', 'desc' => 'Enter your route type, understand route types here https://developers.kaleyra.io/docs/understand-route-types']];
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
            $message_body = $this->getTemplateIdAndMessageBody();
            $arguments = ['headers' => array('api-key' => $this->has_key), 'body' => ['to' => \implode(',', $this->to), 'type' => $this->route_type, 'sender' => $this->from, 'body' => $message_body ? $message_body['message'] : $this->msg]];
            if ($message_body) {
                $arguments['body']['template_id'] = $message_body['template_id'];
            }
            $response = $this->request('POST', "{$this->wsdl_link}/{$this->sid_key}/messages", [], $arguments);
            // Log the result
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
            if (!$this->has_key) {
                throw new Exception(__('The API Key for this gateway is not set', 'wp-sms-pro'));
            }
            return 1;
        } catch (\Exception $e) {
            return new \WP_Error('account-credit', $e->getMessage());
        }
    }
}

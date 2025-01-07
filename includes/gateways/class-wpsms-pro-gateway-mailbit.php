<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
class mailbit extends Gateway
{
    private $wsdl_link = "http://api.mailbit.co.th:8001/api";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
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
            $this->to = \implode(',', $this->to);
            $params = array('username' => $this->username, 'password' => $this->password, 'ani' => $this->from, 'dnis' => $this->to, 'message' => $this->msg, 'command' => 'submit', 'longMessageMode' => 'payload');
            $ch = \curl_init($this->wsdl_link);
            \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, \true);
            \curl_setopt($ch, \CURLOPT_POST, \true);
            \curl_setopt($ch, \CURLOPT_POSTFIELDS, \http_build_query($params));
            $response = \curl_exec($ch);
            $httpCode = \curl_getinfo($ch, \CURLINFO_HTTP_CODE);
            \curl_close($ch);
            if ($httpCode != 200) {
                throw new Exception("Error Code: {$httpCode} - Message: {$response}");
            }
            $this->log($this->from, $this->msg, $this->to, $response);
            /**
             * Run hook after send sms.
             *
             * @param string $response result output.
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
        return 'Unable to check balance!';
    }
}

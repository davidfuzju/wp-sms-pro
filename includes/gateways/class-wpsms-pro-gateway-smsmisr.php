<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class smsmisr extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://smsmisr.com/api";
    public $tariff = "https://smsmisr.com/";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \false;
        $this->bulk_send = \true;
        $this->validateNumber = "e.g. 2011XXXXXX,2012XXXXX,2010XXXXX,...";
        $this->help = "";
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'Username', 'desc' => 'Enter your username of gateway'], 'password' => ['id' => 'gateway_password', 'name' => 'API Secret', 'desc' => 'Enter your API Secret.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender Token', 'desc' => 'Enter your Sender Token.']];
    }
    public function SendSMS()
    {
        /**
         * Modify sender number
         *
         * @param string $this ->from sender number.
         *
         * @since 3.4
         *
         */
        $this->from = apply_filters('wp_sms_from', $this->from);
        /**
         * Modify Receiver number
         *
         * @param array $this ->to receiver number
         *
         * @since 3.4
         *
         */
        $this->to = apply_filters('wp_sms_to', $this->to);
        /**
         * Modify text message
         *
         * @param string $this ->msg text message.
         *
         * @since 3.4
         *
         */
        $this->msg = apply_filters('wp_sms_msg', $this->msg);
        try {
            $language = 1;
            $arguments = ['environment' => 1, 'username' => $this->username, 'password' => $this->password, 'sender' => \urlencode(\trim($this->from)), 'mobile' => \implode(",", $this->to)];
            if (\strlen($this->msg) != \strlen(\utf8_decode($this->msg))) {
                $language = 2;
            }
            if (isset($this->options['send_unicode']) && $this->options['send_unicode']) {
                $language = 3;
                $this->msg = $this->convertToUnicode($this->msg);
            }
            if ($this->sms_action == 'WP_SMS\\Pro\\WooCommerce\\Otp::processVerificationAjaxHandler') {
                $msg_pieces = $this->getTemplateIdAndMessageBody();
                $arguments['template'] = $msg_pieces['template_id'];
                $this->msg = $this->payload['code'];
                $arguments['otp'] = $this->msg;
                $wsdl_link = "{$this->wsdl_link}/OTP";
            } else {
                $arguments['language'] = $language;
                $arguments['message'] = $this->msg;
                $wsdl_link = "{$this->wsdl_link}/SMS";
            }
            $response = $this->request('POST', $wsdl_link, [], ['timeout' => 30, 'body' => $arguments]);
            if (isset($response->code) and \in_array($response->code, [4901, 1901]) === \false) {
                throw new Exception($this->getErrorMessageByCode($response->code));
            }
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
        } catch (Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        try {
            // Check username and password
            if (!$this->username or !$this->password) {
                return new WP_Error('account-credit', __('The username/password for this gateway is not set', 'wp-sms'));
            }
            $response = $this->request('POST', $this->wsdl_link . '/Balance', ['username' => $this->username, 'password' => $this->password]);
            if (isset($response->Balance)) {
                return $response->Balance;
            }
            throw new Exception($this->getErrorMessageByCode($response->code));
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
    private function getErrorMessageByCode($code)
    {
        switch ($code) {
            case '4901':
            case '1901':
                return 'Success, Message Submitted Successfully';
            case '1902':
                return 'Invalid Request';
            case '4903':
            case '1903':
                return 'Invalid value in username or password field';
            case '4904':
            case '1904':
                return 'Invalid value in "sender" field';
            case '4905':
            case '1905':
                return 'Invalid value in "mobile" field';
            case '4906':
            case '1906':
                return 'Insufficient Credit';
            case '4907':
            case '1907':
                return 'Server under updating';
            case '1908':
                return 'Invalid Date & Time format in “DelayUntil=” parameter';
            case '1909':
                return 'Invalid Message';
            case '1910':
                return 'Invalid Language1910';
            case '1911':
                return 'Text is too long';
            case '1912':
                return 'Invalid Environment';
            case '4908':
                return 'Invalid Otp.  ';
            case '4909':
                return 'Invalid Template Token';
            case '4912':
                return 'Invalid Environment.';
            default:
                return "Error code: {$code}";
        }
    }
}

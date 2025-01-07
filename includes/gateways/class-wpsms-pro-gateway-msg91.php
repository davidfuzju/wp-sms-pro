<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class msg91 extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://control.msg91.com/api/v5";
    public $tariff = "https://msg91.com";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $template_id = '';
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->has_key = \true;
        $this->validateNumber = "";
        $this->help = "To pass the Template ID in your message, please use the following format: <br><br><b>variableName1=value:variableName2=value|templateId</b><br><br>Here, variables are separated by <b>:</b> and the Template ID is specified using <b>|</b>. You can include any number of variables.";
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => 'Authentication Key', 'desc' => 'Enter Auth Key of the gateway.'], 'template_id' => ['id' => 'gateway_template_id', 'name' => 'Template ID', 'desc' => 'Enter a valid Template ID.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender ID', 'desc' => 'Enter your Sender ID.']];
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
            $recipients = array();
            $template = $this->getTemplateIdAndMessageBody();
            $templateVariables = [];
            if ($template) {
                $messageVars = \explode(':', $template['message']);
                foreach ($messageVars as $var) {
                    list($messageKey, $messageValue) = \explode('=', $var);
                    $templateVariables[$messageKey] = \trim($messageValue);
                }
            }
            foreach ($this->to as $recipient) {
                $recipientData = ['mobiles' => $recipient];
                if ($templateVariables) {
                    foreach ($templateVariables as $key => $value) {
                        $recipientData[$key] = $value;
                    }
                }
                $recipients[] = $recipientData;
            }
            $arguments = array('headers' => array('accept' => 'application/json', 'content-type' => 'application/json', 'authkey' => $this->has_key), 'body' => \json_encode(array('template_id' => $template ? $template['template_id'] : $this->template_id, 'sender' => $this->from, 'recipients' => $recipients)));
            $response = $this->request('POST', "{$this->wsdl_link}/flow", [], $arguments);
            // Error Handler
            if (isset($response) and !empty($response->error)) {
                throw new Exception($response->message);
            }
            if ($response->type != 'success') {
                throw new Exception($response->message);
            }
            // Log the result
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
        try {
            // Authentication Key validation
            if (!$this->has_key) {
                return new WP_Error('account-credit', __('Authentication Key is required.', 'wp-sms'));
            }
            return 1;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}

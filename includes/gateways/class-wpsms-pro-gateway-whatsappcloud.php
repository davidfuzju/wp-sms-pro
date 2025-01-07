<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class whatsappcloud extends \WP_SMS\Gateway
{
    public $tariff = "https://business.whatsapp.com";
    public $wsdl_link = 'https://graph.facebook.com/v16.0';
    public $unitrial = \true;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $supportMedia = \true;
    public $supportIncoming = \true;
    public $business_account_id = "";
    public $language_code;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->has_key = \true;
        $this->supportIncoming = \false;
        $this->documentUrl = 'https://wp-sms-pro.com/resources/whatsapp-cloud-gateway-configuration/';
        $this->help = 'For configuration gateway, for more information, please <a target="_blank" href="https://developers.facebook.com/docs/whatsapp/business-management-api/get-started#required-assets">click here</a>.';
        $this->validateNumber = "The number to which the message will be sent. Be sure that all phone numbers include country code, area code, and phone number without spaces or dashes (e.g., 14153336666).";
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_user_access_token', 'name' => 'User Access Token', 'desc' => "You can get the access token from the bellow:\n                <ul>\n                    <li>A <a target='_blank' href='https://developers.facebook.com/micro_site/url/?click_from_context_menu=true&country=RU&destination=https%3A%2F%2Fwww.facebook.com%2Fbusiness%2Fhelp%2F503306463479099&event_type=click&last_nav_impression_id=03wHbpLrXR7tn50tK&max_percent_page_viewed=100&max_viewport_height_px=1113&max_viewport_width_px=2273&orig_http_referrer=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fwhatsapp%2Fbusiness-management-api%2Fget-started&orig_request_uri=https%3A%2F%2Fdevelopers.facebook.com%2Fajax%2Fdocs%2Fnav%2F%3Fpath1%3Dwhatsapp%26path2%3Dbusiness-management-api%26path3%3Dget-started&region=emea&scrolled=true&session_id=1iA0ArIKPpJXgYlWY&site=developers'>System User access token created in the WhatsApp Business Accounts tab of the Business Manager</a>, to access assets for a business manager</li>\n                    <li>A <a target='_blank' href='https://developers.facebook.com/micro_site/url/?click_from_context_menu=true&country=RU&destination=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Ffacebook-login%2Fguides%2Faccess-tokens%23usertokens&event_type=click&last_nav_impression_id=03wHbpLrXR7tn50tK&max_percent_page_viewed=100&max_viewport_height_px=1113&max_viewport_width_px=2273&orig_http_referrer=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fwhatsapp%2Fbusiness-management-api%2Fget-started&orig_request_uri=https%3A%2F%2Fdevelopers.facebook.com%2Fajax%2Fdocs%2Fnav%2F%3Fpath1%3Dwhatsapp%26path2%3Dbusiness-management-api%26path3%3Dget-started&region=emea&scrolled=true&session_id=1iA0ArIKPpJXgYlWY&site=developers'>User access token via Facebook Login</a>, when your business will be acting on behalf of the User The whatsapp_business_management permission</li>\n                </ul>"], 'business_account_id' => ['id' => 'gateway_business_account_id', 'name' => 'WhatsApp Business Account ID', 'desc' => 'Enter your WhatsApp Business Account ID'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Phone Number ID', 'desc' => 'Sender Number ID, for more information, please <a target="_blank" href="https://developers.facebook.com/docs/whatsapp/cloud-api/get-started/#phone-number">click here</a>.'], 'language_code' => ['id' => 'gateway_language_code', 'name' => 'Language Code', 'type' => 'text', 'desc' => 'The default language code is en_US.']];
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
            $responseArray = [];
            $variables = [];
            $supportedMessageTypeByWhatsApp = ['audio', 'document', 'image', 'sticker', 'video'];
            $whatsAppMsgType = null;
            $messageContent_pieces = $this->getTemplateIdAndMessageBody();
            $messageContent = $messageContent_pieces['message'];
            $templateName = $messageContent_pieces['template_id'];
            if (!isset($templateName)) {
                throw new Exception(__('Please provide the name of the message template.', 'wp-sms-pro'));
            }
            if (!empty($this->media)) {
                $whatsAppMsgType = $this->getWhatsAppMessageType();
                if (!\in_array($whatsAppMsgType, $supportedMessageTypeByWhatsApp)) {
                    throw new Exception(__('The file you have uploaded is not compatible/supported.', 'wp-sms-pro'));
                }
            }
            if (!empty($messageContent)) {
                $variables = $this->fetchVariables($messageContent);
            }
            $requestData = $this->bindRequestParams($templateName, $variables, $whatsAppMsgType);
            $body = ['messaging_product' => 'whatsapp', 'recipient_type' => 'individual', 'type' => 'template', 'template' => $requestData];
            foreach ($this->to as $number) {
                $body['to'] = $number;
                $arguments = ['headers' => ['Authorization' => "Bearer {$this->has_key}", 'Content-Type' => 'application/json'], 'body' => \json_encode($body)];
                $response = $this->request('POST', "{$this->wsdl_link}/{$this->from}/messages", [], $arguments);
                if (!isset($response->contacts[0]->wa_id)) {
                    throw new Exception($response);
                }
                /*
                 * Log the result
                 */
                $this->log($this->from, $this->msg, $this->to, $response, 'success', $this->media);
                $responseArray[] = $response;
            }
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $responseArray);
            return $responseArray;
        } catch (Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        try {
            // Check username and password
            if (!$this->has_key or !$this->from or !$this->business_account_id) {
                throw new Exception(__('User Access Token and WhatsApp Business Account ID are required.', 'wp-sms-pro'));
            }
            $arguments = ['headers' => array('Authorization' => "Bearer {$this->has_key}", 'Content-Type' => 'application/json')];
            $response = $this->request('GET', "{$this->wsdl_link}/{$this->business_account_id}", ['access_token' => $this->has_key], $arguments);
            if (isset($response->currency) && isset($response->name)) {
                return $response->name . ' - ' . $response->currency;
            }
            return 1;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
    /**
     * @param $body
     * @return array|false
     */
    public function fetchVariables($body)
    {
        $result = \explode(',', $body);
        foreach ($result as $item) {
            $response[] = ['type' => 'text', 'text' => $item];
        }
        if (empty($response)) {
            return \false;
        }
        return $response;
    }
    /**
     * @return string
     */
    public function getWhatsAppMessageType()
    {
        $mimeType = wp_check_filetype($this->media[0])['type'];
        $mimeType = \explode('/', $mimeType);
        switch ($mimeType[0]) {
            case 'image':
                $type = 'image';
                break;
            case 'audio':
                $type = 'audio';
                break;
            case 'video':
                $type = 'video';
                break;
            default:
                $type = 'document';
        }
        return $type;
    }
    /**
     * @param $template_name
     * @param $variables
     * @param $message_type
     *
     * @return array
     */
    public function bindRequestParams($template_name, $variables, $message_type)
    {
        $langCode = empty($this->language_code) ? 'en_US' : $this->language_code;
        $data = ['name' => $template_name, 'language' => ['code' => $langCode], 'components' => [['type' => 'body']]];
        if ($variables) {
            $data['components'][0]['parameters'] = $variables;
        }
        if (!empty($this->media) && $message_type) {
            $mediaData = ['type' => 'header', 'parameters' => ['type' => $message_type, $message_type => ['link' => $this->media[0]]]];
            $data['components'][] = $mediaData;
        }
        return $data;
    }
}

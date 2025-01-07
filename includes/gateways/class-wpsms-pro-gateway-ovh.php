<?php

namespace WP_SMS\Gateway;

class ovh extends \WP_SMS\Gateway
{
    public $tariff = "https://www.ovh.co.uk/sms/";
    public $unitrial = \true;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->validateNumber = "Format d'un numéro : 06XXXXXXXX ou 07XXXXXXXX ou +336XXXXXXXX ou +337XXXXXXXX";
        $this->help = 'Enter the following settings for the OVH gateway: API Username = Consumer Key, API Password = Application Secret, API Key = Application Key, Sender number = Application name. You can find these details in your OVH account.';
        $this->has_key = \true;
        //$this->bulk_send      = false;
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
        // Get the credit.
        $credit = $this->GetCredit();
        // Check gateway credit
        if (is_wp_error($credit)) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $credit->get_error_message(), 'error');
            return $credit;
        }
        $result = array();
        // Get declared senders
        $sender_names = array();
        $curl = \curl_init();
        $url = 'https://eu.api.ovh.com/1.0/sms/' . $this->options['gateway_sender_id'] . '/senders';
        $now = \time();
        $toSign = $this->password . '+' . $this->username . '+' . 'GET' . '+' . $url . '+' . '' . '+' . $now;
        $signature = '$1$' . \sha1($toSign);
        \curl_setopt_array($curl, array(\CURLOPT_RETURNTRANSFER => 1, \CURLOPT_URL => $url, \CURLOPT_HTTPHEADER => array('Content-Type: application/json; charset=utf-8', 'X-Ovh-Application: ' . $this->has_key, 'X-Ovh-Consumer: ' . $this->username, 'X-Ovh-Timestamp: ' . $now, 'X-Ovh-Signature: ' . $signature)));
        $contents = \curl_exec($curl);
        $http_code = \curl_getinfo($curl, \CURLINFO_HTTP_CODE);
        \curl_close($curl);
        if (200 == $http_code) {
            $result = \json_decode($contents, \true);
            if (\is_array($result)) {
                $sender_names = $result;
            }
        }
        $senders = array();
        foreach ($sender_names as $sender_name) {
            $curl = \curl_init();
            $url = 'https://eu.api.ovh.com/1.0/sms/' . $this->options['gateway_sender_id'] . '/senders/' . \str_replace(' ', '%20', $sender_name);
            $now = \time();
            $toSign = $this->password . '+' . $this->username . '+' . 'GET' . '+' . $url . '+' . '' . '+' . $now;
            $signature = '$1$' . \sha1($toSign);
            \curl_setopt_array($curl, array(\CURLOPT_RETURNTRANSFER => 1, \CURLOPT_URL => $url, \CURLOPT_HTTPHEADER => array('Content-Type: application/json; charset=utf-8', 'X-Ovh-Application: ' . $this->has_key, 'X-Ovh-Consumer: ' . $this->username, 'X-Ovh-Timestamp: ' . $now, 'X-Ovh-Signature: ' . $signature)));
            $contents = \curl_exec($curl);
            $http_code = \curl_getinfo($curl, \CURLINFO_HTTP_CODE);
            \curl_close($curl);
            if (200 == $http_code) {
                $result = \json_decode($contents, \true);
                if (\is_array($result)) {
                    $senders[] = $result;
                }
            }
        }
        $custom_sender = \false;
        foreach ($senders as $sender) {
            if ('enable' === $sender['status']) {
                $custom_sender = $sender['sender'];
            }
        }
        // Create a new message
        $receivers = array();
        foreach ($this->to as $item) {
            $item = \preg_replace('/\\s/', '', $item);
            // Correct prefix added with trailing 0 and multiple prefixes
            $item = \preg_replace('/(\\+33)+0?/', '+33', $item);
            if (!\in_array($item, $receivers)) {
                // Only add number if it respects the norm
                if (\preg_match('/^(?:(?:\\+|00)33|0)[67]\\d{8}$/', $item)) {
                    $receivers[] = $item;
                }
            }
        }
        if (!$receivers) {
            throw new \Exception('send-sms', __('No valid receiver found' . \var_export($this->to, \true), 'wp-sms'));
        }
        $params = array('message' => \stripslashes($this->msg), 'noStopClause' => \true, 'receivers' => $receivers);
        if ($custom_sender) {
            $params['sender'] = $custom_sender;
        } else {
            $params['senderForResponse'] = \true;
        }
        $body = \json_encode($params, \JSON_THROW_ON_ERROR | \JSON_UNESCAPED_SLASHES);
        $curl = \curl_init();
        $url = 'https://eu.api.ovh.com/1.0/sms/' . $this->options['gateway_sender_id'] . '/jobs';
        $now = \time();
        $toSign = $this->password . '+' . $this->username . '+' . 'POST' . '+' . $url . '+' . $body . '+' . $now;
        $signature = '$1$' . \sha1($toSign);
        \curl_setopt_array($curl, array(\CURLOPT_POST => 1, \CURLOPT_POSTFIELDS => $body, \CURLOPT_RETURNTRANSFER => 1, \CURLOPT_URL => $url, \CURLOPT_HTTPHEADER => array('Content-Type: application/json; charset=utf-8', 'X-Ovh-Application: ' . $this->has_key, 'X-Ovh-Consumer: ' . $this->username, 'X-Ovh-Timestamp: ' . $now, 'X-Ovh-Signature: ' . $signature)));
        $contents = \curl_exec($curl);
        $http_code = \curl_getinfo($curl, \CURLINFO_HTTP_CODE);
        \curl_close($curl);
        if (200 == $http_code) {
            $result = \json_decode($contents, \true);
            if (\is_array($result)) {
                $sender_names = $result;
            }
        }
        if (\is_array($result) && isset($result['validReceivers']) && \count($result['validReceivers']) > 0) {
            // Log the result
            $this->log($this->from, $this->msg, $receivers, \json_encode($result));
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $result);
            return $result;
        }
        // Log the result
        $this->log($this->from, $this->msg, $receivers, \json_encode($contents), 'error');
        return new \WP_Error('send-sms', __('Sending SMS failed, system response:', 'wp-sms') . ' ' . \json_encode($contents));
    }
    public function GetCredit()
    {
        try {
            // Check username and password and key
            if (!$this->username or !$this->password or !$this->has_key) {
                throw new \Exception(__('Username/Password or API Key does not set for this gateway', 'wp-sms-pro'));
            }
            $curl = \curl_init();
            $url = 'https://eu.api.ovh.com/1.0/sms/' . $this->options['gateway_sender_id'];
            $now = \time();
            $toSign = $this->password . '+' . $this->username . '+' . 'GET' . '+' . $url . '+' . '' . '+' . $now;
            $signature = '$1$' . \sha1($toSign);
            \curl_setopt_array($curl, array(\CURLOPT_RETURNTRANSFER => 1, \CURLOPT_URL => $url, \CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=utf-8',
                'X-Ovh-Application: ' . $this->has_key,
                // OVH_APP_KEY
                'X-Ovh-Consumer: ' . $this->username,
                // OVH_CONSUMER_KEY
                'X-Ovh-Timestamp: ' . $now,
                'X-Ovh-Signature: ' . $signature,
            )));
            $contents = \curl_exec($curl);
            $http_code = \curl_getinfo($curl, \CURLINFO_HTTP_CODE);
            \curl_close($curl);
            if (200 == $http_code) {
                $result = \json_decode($contents, \true);
                if (\is_array($result) && isset($result['creditsLeft'])) {
                    return $result['creditsLeft'];
                }
            }
            throw new \Exception(\json_encode($contents));
        } catch (\Exception $e) {
            return new \WP_Error('account-credit', __('Retrieving credit failed, system response:', 'wp-sms') . ' ' . $e->getMessage());
        }
    }
}

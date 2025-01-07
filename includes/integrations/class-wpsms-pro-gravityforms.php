<?php

namespace WP_SMS\Pro;

use WP_SMS\Option;
if (!\defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
class GravityForms
{
    public $sms;
    public $options;
    public function __construct()
    {
        global $sms;
        $this->sms = $sms;
        $this->options = Option::getOptions(\true);
        add_action('gform_after_submission', array($this, 'notification_form'), 10, 2);
    }
    public function notification_form($entry, $form)
    {
        // Send to custom number
        if (isset($this->options['gf_notify_enable_form_' . $form['id']])) {
            $to = \explode(',', $this->options['gf_notify_receiver_form_' . $form['id']]);
            $result = array();
            $template_vars = array('%title%' => $form['title'], '%ip%' => $entry['ip'], '%source_url%' => wp_sms_shorturl($entry['source_url']), '%user_agent%' => $entry['user_agent']);
            foreach ($form['fields'] as $items) {
                // Backward compatibility with multi inputs
                if (isset($items['inputs']) && \is_array($items['inputs'])) {
                    $inputEntries = [];
                    foreach ($items['inputs'] as $input) {
                        $inputEntries[] = $entry[$input['id']];
                    }
                    $result[] = \implode(' ', $inputEntries);
                    $template_vars["%field-{$items['id']}%"] = \implode(' ', $inputEntries);
                } else {
                    if (isset($entry[$items['id']])) {
                        $result[] = $entry[$items['id']];
                        $template_vars["%field-{$items['id']}%"] = $entry[$items['id']];
                    }
                }
            }
            $template_vars['%content%'] = \implode("\n", $result);
            $message = \str_replace(\array_keys($template_vars), \array_values($template_vars), $this->options['gf_notify_message_form_' . $form['id']]);
            wp_sms_send($to, $message);
        }
        // Send to field value
        if (isset($this->options['gf_notify_enable_field_form_' . $form['id']])) {
            $to = array($entry[$this->options['gf_notify_receiver_field_form_' . $form['id']]]);
            $result = array();
            $template_vars = array('%title%' => $form['title'], '%ip%' => $entry['ip'], '%source_url%' => wp_sms_shorturl($entry['source_url']), '%user_agent%' => $entry['user_agent']);
            foreach ($form['fields'] as $items) {
                // Backward compatibility with multi inputs
                if (isset($items['inputs']) && \is_array($items['inputs'])) {
                    $inputEntries = [];
                    foreach ($items['inputs'] as $input) {
                        $inputEntries[] = $entry[$input['id']];
                    }
                    $result[] = \implode(' ', $inputEntries);
                    $template_vars["%field-{$items['id']}%"] = \implode(' ', $inputEntries);
                } else {
                    if (isset($entry[$items['id']])) {
                        $result[] = $entry[$items['id']];
                        $template_vars["%field-{$items['id']}%"] = $entry[$items['id']];
                    }
                }
            }
            $template_vars['%content%'] = \implode("\n", $result);
            $message = \str_replace(\array_keys($template_vars), \array_values($template_vars), $this->options['gf_notify_message_field_form_' . $form['id']]);
            wp_sms_send($to, $message);
        }
    }
    static function get_field($form_id)
    {
        if (!$form_id) {
            return;
        }
        $fields = \RGFormsModel::get_form_meta($form_id);
        $option_field = '';
        if ($fields) {
            foreach ($fields['fields'] as $field) {
                $option_field[$field['id']] = $field['label'];
            }
            return $option_field;
        }
    }
}
new \WP_SMS\Pro\GravityForms();

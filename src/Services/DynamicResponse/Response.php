<?php

namespace WP_SMS\Pro\Services\DynamicResponse;

use WP_SMS\Pro\Exceptions\BadMethodCallException;
use WP_SMS\Pro\Exceptions\InvalidPhoneNumberException;
use WP_SMS\Components\NumberParser;
class Response
{
    /**
     * @var string
     */
    private $placeHolderRegex;
    /**
     * @var array
     */
    private $variables = [];
    /**
     * @var string
     */
    private $phoneNumber;
    /**
     * @todo find a proper way to validate the regex
     * @param string $phoneNumber
     * @param boolean $formatInput whether to format input phone number to international format or not
     * @param string $placeHolderRegex
     * @throws InvalidPhoneNumberException
     * @return static
     */
    public function __construct($phoneNumber, $formatInput = \true, $placeHolderRegex = '/\\{(.*?)\\}/')
    {
        $this->setPhoneNumber($phoneNumber, $formatInput);
        $this->placeHolderRegex = $placeHolderRegex;
    }
    /**
     * Set phone number
     *
     * @param string $phoneNumber
     * @throws InvalidPhoneNumberException when $formatInput is set to true and the input is not a valid phone number
     * @param boolean $formatInput whether to format input phone number to international format or not
     * @return void
     */
    private function setPhoneNumber($phoneNumber, $formatInput = \true)
    {
        switch ($formatInput) {
            case \true:
                try {
                    if (!\class_exists(NumberParser::class)) {
                        throw new \Exception();
                    }
                    $numberParser = new NumberParser($phoneNumber);
                    $phoneNumber = $numberParser->getValidNumber();
                    if (is_wp_error($phoneNumber)) {
                        throw new \Exception();
                    }
                    $this->phoneNumber = $phoneNumber;
                } catch (\Throwable $e) {
                    throw new InvalidPhoneNumberException(__('Provided number is not a valid phone number.', 'wp-sms-pro'));
                }
                break;
            case \false:
                $this->phoneNumber = sanitize_text_field($phoneNumber);
                break;
        }
    }
    /**
     * Add a new variable to the list within a context
     *
     * @param string $key
     * @param mixed $valueCallback
     * @param string $context used to differentiate between variables of different contexts e.g. `success` or `failure`
     * @return static
     */
    public function addVariable($key, $value, $context = 'default')
    {
        $this->variables[$context][$key] = new \WP_SMS\Pro\Services\DynamicResponse\DynamicVariable($key, $value);
        return $this;
    }
    /**
     * Add multiple variables in associative array forma
     *
     * @param array $variables [ string $key => mixed $value]
     * @param string $context
     * @return void
     */
    public function addMultipleVariables($variables, $context = 'default')
    {
        foreach ($variables as $variableKey => $variableValue) {
            $this->addVariable($variableKey, $variableValue, $context);
        }
        return $this;
    }
    /**
     * Add variables from an external delegate
     *
     * @param string $delegate delegate's qualified class name
     * @param array $data data to be passed to the delegate
     * @throws BadMethodCallException
     * @return static
     */
    public function addVariablesFromDelegate($delegate, $data = [])
    {
        if (!\is_subclass_of($delegate, \WP_SMS\Pro\Services\DynamicResponse\ResponseDelegateAbstract::class)) {
            throw new BadMethodCallException("Given class is not a subclass of " . \WP_SMS\Pro\Services\DynamicResponse\ResponseDelegateAbstract::class);
        }
        try {
            $delegate = new $delegate($this, $data);
            $delegate->checkRequirements() && $delegate->addDelegateVariables();
        } catch (\Throwable $error) {
            //TODO log the error
        } finally {
            return $this;
        }
    }
    /**
     * Get a single variable object
     *
     * @param string $key
     * @param string $context used to differentiate between variables of different contexts e.g. `success` or `failure`
     * @return array|null
     */
    public function getVariable($key = null, $context = 'default')
    {
        return isset($this->variables[$context][$key]) ? $this->variables[$context][$key] : null;
    }
    /**
     * Get all dynamic variables inside the response
     *
     * @return array
     */
    public function getAllVariables()
    {
        return $this->variables;
    }
    /**
     * Get placeHolders' regex
     *
     * @return string
     */
    public function getPlaceHolderRegex()
    {
        return $this->placeHolderRegex;
    }
    /**
     * Get the phone number associated with this response instance
     *
     * @return string $phoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    /**
     * Replace dynamic variables in a given text
     *
     * @param string $text
     * @param string $context used to differentiate between variables of different contexts e.g. `success` or `failure`
     * @return string
     */
    public function replaceVariablesInText($text, $context = 'default')
    {
        \preg_match_all($this->placeHolderRegex, $text, $matches);
        $placeHolders = $matches[0];
        $foundVars = $matches[1];
        foreach ($foundVars as $key => $varName) {
            $varObj = $this->getVariable($varName, $context);
            $value = isset($varObj) && $varObj instanceof \WP_SMS\Pro\Services\DynamicResponse\DynamicVariable ? $varObj->getValue() : '';
            $foundVars[$key] = (string) $value;
        }
        return \str_replace($placeHolders, $foundVars, $text);
    }
    /**
     * Send sms response
     *
     * @return string|\WP_Error
     */
    public function send($text, $context = 'default')
    {
        $text = $this->replaceVariablesInText($text, $context);
        return wp_sms_send([$this->phoneNumber], $text);
    }
}

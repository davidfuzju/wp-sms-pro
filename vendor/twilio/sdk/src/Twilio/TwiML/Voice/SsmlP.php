<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\TwiML\Voice;

use WPSmsPro\Vendor\Twilio\TwiML\TwiML;
class SsmlP extends TwiML
{
    /**
     * SsmlP constructor.
     *
     * @param string $words Words to speak
     */
    public function __construct($words)
    {
        parent::__construct('p', $words);
    }
    /**
     * Add Break child.
     *
     * @param array $attributes Optional attributes
     * @return SsmlBreak Child element.
     */
    public function break_($attributes = []) : SsmlBreak
    {
        return $this->nest(new SsmlBreak($attributes));
    }
    /**
     * Add Emphasis child.
     *
     * @param string $words Words to emphasize
     * @param array $attributes Optional attributes
     * @return SsmlEmphasis Child element.
     */
    public function emphasis($words, $attributes = []) : SsmlEmphasis
    {
        return $this->nest(new SsmlEmphasis($words, $attributes));
    }
    /**
     * Add Lang child.
     *
     * @param string $words Words to speak
     * @param array $attributes Optional attributes
     * @return SsmlLang Child element.
     */
    public function lang($words, $attributes = []) : SsmlLang
    {
        return $this->nest(new SsmlLang($words, $attributes));
    }
    /**
     * Add Phoneme child.
     *
     * @param string $words Words to speak
     * @param array $attributes Optional attributes
     * @return SsmlPhoneme Child element.
     */
    public function phoneme($words, $attributes = []) : SsmlPhoneme
    {
        return $this->nest(new SsmlPhoneme($words, $attributes));
    }
    /**
     * Add Prosody child.
     *
     * @param string $words Words to speak
     * @param array $attributes Optional attributes
     * @return SsmlProsody Child element.
     */
    public function prosody($words, $attributes = []) : SsmlProsody
    {
        return $this->nest(new SsmlProsody($words, $attributes));
    }
    /**
     * Add S child.
     *
     * @param string $words Words to speak
     * @return SsmlS Child element.
     */
    public function s($words) : SsmlS
    {
        return $this->nest(new SsmlS($words));
    }
    /**
     * Add Say-As child.
     *
     * @param string $words Words to be interpreted
     * @param array $attributes Optional attributes
     * @return SsmlSayAs Child element.
     */
    public function say_As($words, $attributes = []) : SsmlSayAs
    {
        return $this->nest(new SsmlSayAs($words, $attributes));
    }
    /**
     * Add Sub child.
     *
     * @param string $words Words to be substituted
     * @param array $attributes Optional attributes
     * @return SsmlSub Child element.
     */
    public function sub($words, $attributes = []) : SsmlSub
    {
        return $this->nest(new SsmlSub($words, $attributes));
    }
    /**
     * Add W child.
     *
     * @param string $words Words to speak
     * @param array $attributes Optional attributes
     * @return SsmlW Child element.
     */
    public function w($words, $attributes = []) : SsmlW
    {
        return $this->nest(new SsmlW($words, $attributes));
    }
}

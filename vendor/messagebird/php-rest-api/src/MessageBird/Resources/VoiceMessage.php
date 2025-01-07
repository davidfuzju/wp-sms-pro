<?php

namespace WPSmsPro\Vendor\MessageBird\Resources;

use WPSmsPro\Vendor\MessageBird\Objects;
use WPSmsPro\Vendor\MessageBird\Common;
/**
 * Class VoiceMessage
 *
 * @package MessageBird\Resources
 */
class VoiceMessage extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\VoiceMessage());
        $this->setResourceName('voicemessages');
        parent::__construct($HttpClient);
    }
}

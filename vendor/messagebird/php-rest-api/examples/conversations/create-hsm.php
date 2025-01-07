<?php

namespace {
    // Initiates a conversation by sending a first message. This example uses a hsm message.
    require __DIR__ . '/../../autoload.php';
    $messageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $content = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Content();
    $hsm = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\HSM\Message();
    $hsmParams = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\HSM\Params();
    $hsmParams->default = 'YOUR TEMPLATE PARAM';
    $hsmLanguage = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\HSM\Language();
    $hsmLanguage->policy = \WPSmsPro\Vendor\MessageBird\Objects\Conversation\HSM\Language::DETERMINISTIC_POLICY;
    //$hsmLanguage->policy = \MessageBird\Objects\Conversation\HSM\Language::FALLBACK_POLICY;
    $hsmLanguage->code = 'YOUR LANGUAGE CODE';
    $hsm->templateName = 'YOUR TEMPLATE NAME';
    $hsm->namespace = 'YOUR NAMESPACE';
    $hsm->params = array($hsmParams);
    $hsm->language = $hsmLanguage;
    $content->hsm = $hsm;
    $message = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Message();
    $message->channelId = 'YOUR CHANNEL ID';
    $message->content = $content;
    $message->to = 'YOUR MSISDN';
    $message->type = 'hsm';
    try {
        $conversation = $messageBird->conversations->start($message);
        \var_dump($conversation);
    } catch (\Exception $e) {
        echo \sprintf("%s: %s", \get_class($e), $e->getMessage());
    }
}

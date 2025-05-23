<?php

namespace {
    // Sends a message to an existing conversation, with media as its content.
    // Supported media types are 'audio', 'file', 'image' and 'video.
    require __DIR__ . '/../../autoload.php';
    $messageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $content = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Content();
    $content->image = array('url' => 'https://cdn-gc.messagebird.com/assets/images/logo.png');
    $message = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Message();
    $message->channelId = 'CHANNEL_ID';
    $message->content = $content;
    $message->to = 'RECIPIENT_MSISDN';
    $message->type = \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Content::TYPE_IMAGE;
    // 'image'
    try {
        // Using a contactId instead of a conversationId is also supported.
        $conversation = $messageBird->conversationMessages->create('CONVERSATION_ID', $message);
        \var_dump($conversation);
    } catch (\Exception $e) {
        echo \sprintf("%s: %s", \get_class($e), $e->getMessage());
    }
}

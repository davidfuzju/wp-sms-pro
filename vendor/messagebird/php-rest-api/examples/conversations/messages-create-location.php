<?php

namespace {
    // Sends a message to an existing conversation, with a location as its content.
    require __DIR__ . '/../../autoload.php';
    $messageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $content = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Content();
    $content->location = array('latitude' => 52.379112, 'longitude' => 4.900384);
    $message = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Message();
    $message->channelId = 'CHANNEL_ID';
    $message->content = $content;
    $message->to = 'RECIPIENT';
    $message->type = \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Content::TYPE_LOCATION;
    // 'location'
    try {
        $conversation = $messageBird->conversationMessages->create('CONVERSATION_ID', $message);
        \var_dump($conversation);
    } catch (\Exception $e) {
        echo \sprintf("%s: %s", \get_class($e), $e->getMessage());
    }
}

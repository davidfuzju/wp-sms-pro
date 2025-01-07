<?php

namespace {
    // Initiates a conversation by sending a first message. This example uses a
    // plain text message, but other types are also available. See the
    // conversations-messages-create examples.
    require __DIR__ . '/../../autoload.php';
    // Set your own API access key here.
    // Create a client with WhatsApp sandbox enabled.
    $messageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY', null, [\WPSmsPro\Vendor\MessageBird\Client::ENABLE_CONVERSATIONSAPI_WHATSAPP_SANDBOX]);
    // Use WhatsApp sandbox channel as normal.
    $content = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Content();
    $content->text = 'Hello world';
    $message = new \WPSmsPro\Vendor\MessageBird\Objects\Conversation\Message();
    $message->channelId = 'WHATSAPP_SANDBOX_CHANNEL_ID';
    $message->content = $content;
    $message->to = 'RECIPIENT';
    // Channel-specific, e.g. MSISDN for SMS.
    $message->type = 'text';
    try {
        $conversation = $messageBird->conversations->start($message);
        \var_dump($conversation);
    } catch (\Exception $e) {
        echo \sprintf("%s: %s", \get_class($e), $e->getMessage());
    }
}

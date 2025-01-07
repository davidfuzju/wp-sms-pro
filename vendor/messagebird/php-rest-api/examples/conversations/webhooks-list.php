<?php

namespace {
    // Retrieves all webhooks this key has access to. Pagination is supported
    // through the optional 'limit' and 'offset' parameters.
    require __DIR__ . '/../../autoload.php';
    $messageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    try {
        $webhooks = $messageBird->conversationWebhooks->getList();
        \var_dump($webhooks);
    } catch (\Exception $e) {
        echo \sprintf("%s: %s", \get_class($e), $e->getMessage());
    }
}

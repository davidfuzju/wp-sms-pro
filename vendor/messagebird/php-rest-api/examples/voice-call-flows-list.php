<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $messageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    try {
        $result = $messageBird->voiceCallFlows->getList(array('offset' => 100, 'limit' => 30));
        \var_dump($result);
    } catch (\Exception $e) {
        echo \sprintf("%s: %s", \get_class($e), $e->getMessage());
    }
}

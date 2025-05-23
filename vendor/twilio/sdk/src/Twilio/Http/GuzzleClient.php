<?php

namespace WPSmsPro\Vendor\Twilio\Http;

use WPSmsPro\Vendor\GuzzleHttp\ClientInterface;
use WPSmsPro\Vendor\GuzzleHttp\Exception\BadResponseException;
use WPSmsPro\Vendor\GuzzleHttp\Psr7\Query;
use WPSmsPro\Vendor\GuzzleHttp\Psr7\Request;
use WPSmsPro\Vendor\Twilio\Exceptions\HttpException;
final class GuzzleClient implements Client
{
    /**
     * @var ClientInterface
     */
    private $client;
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
    public function request(string $method, string $url, array $params = [], array $data = [], array $headers = [], string $user = null, string $password = null, int $timeout = null) : Response
    {
        try {
            $body = Query::build($data, \PHP_QUERY_RFC1738);
            $options = ['timeout' => $timeout, 'auth' => [$user, $password], 'body' => $body];
            if ($params) {
                $options['query'] = $params;
            }
            $response = $this->client->send(new Request($method, $url, $headers), $options);
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse();
        } catch (\Exception $exception) {
            throw new HttpException('Unable to complete the HTTP request', 0, $exception);
        }
        // Casting the body (stream) to a string performs a rewind, ensuring we return the entire response.
        // See https://stackoverflow.com/a/30549372/86696
        return new Response($response->getStatusCode(), (string) $response->getBody(), $response->getHeaders());
    }
}

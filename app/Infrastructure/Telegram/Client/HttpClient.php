<?php

namespace App\Infrastructure\Telegram\Client;

use App\Infrastructure\Telegram\Client\Exception\TelegramHttpClientException;
use App\Infrastructure\Telegram\Client\Request\AbstractRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class HttpClient
{
    private const REQUEST_HEADERS = [
        'Accept-Encoding' => 'gzip, deflate, br',
    ];

    /**
     * @param Client $client
     * @param string $baseUrl
     */
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl
    ) {
    }

    /**
     * @param AbstractRequest $request
     *
     * @return array
     * @throws TelegramHttpClientException
     */
    public function sendRequest(AbstractRequest $request): array
    {
        $endpoint = $this->baseUrl . '/' .$request->getEndpoint();
        $requestParams = $request->getParams();
        $method = $request->getMethod();

        $options = [
            RequestOptions::HEADERS => self::REQUEST_HEADERS
        ];

        match ($method) {
            HttpRequest::METHOD_POST => $options[RequestOptions::JSON] = $requestParams,
            HttpRequest::METHOD_GET => $options[RequestOptions::QUERY] = $requestParams,
        };

        try {
            $response = $this->client->request($method, $endpoint, $options);
        } catch (ClientException|GuzzleException $e) {
            $content = $e->getResponse()->getBody()->getContents();
            throw new TelegramHttpClientException($content);
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}

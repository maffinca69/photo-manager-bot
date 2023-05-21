<?php

namespace App\Services\Telegram;

use App\Infrastructure\Config\ConfigService;
use App\Infrastructure\Telegram\Client\Exception\TelegramHttpClientException;
use App\Infrastructure\Telegram\Client\HttpClient;
use App\Infrastructure\Telegram\Client\Request\SendMediaGroupRequest;
use App\Services\Telegram\DTO\MediaGroupRequestDTO;
use App\Services\Telegram\Hydrator\MediaPhotoHydrator;

class TelegramDocumentsPublishingService
{
    /**
     * @param MediaPhotoHydrator $mediaPhotoHydrator
     * @param ConfigService $configService
     * @param HttpClient $client
     */
    public function __construct(
        private readonly MediaPhotoHydrator $mediaPhotoHydrator,
        private readonly ConfigService $configService,
        private readonly HttpClient $client
    ) {
    }

    /**
     * @param MediaGroupRequestDTO $requestDTO
     * @return void
     * @throws TelegramHttpClientException
     */
    public function publish(MediaGroupRequestDTO $requestDTO): void
    {
        $username = $requestDTO->getChatUsername();
        $config = $this->configService->get('channels');
        if (!isset($config[$username])) {
            throw new \RuntimeException("Not found channel [$username] in config");
        }

        $request = new SendMediaGroupRequest([
            'chat_id' => sprintf('@%s', $config[$username]),
            'media' => $this->mediaPhotoHydrator->extract($requestDTO)
        ]);

        $this->client->sendRequest($request);
    }
}

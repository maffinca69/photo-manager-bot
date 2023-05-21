<?php

namespace App\Services\Telegram\File;

use App\Infrastructure\Telegram\Client\Exception\TelegramHttpClientException;
use App\Infrastructure\Telegram\Client\HttpClient;
use App\Infrastructure\Telegram\Client\Request\GetFileRequest;
use App\Services\Telegram\DTO\FileInfoDTO;

class FileInfoGettingService
{
    /**
     * @param HttpClient $client
     */
    public function __construct(
        private readonly HttpClient $client
    ) {
    }

    /**
     * @param string $fileId
     * @return FileInfoDTO|null
     * @throws TelegramHttpClientException
     */
    public function get(string $fileId): ?FileInfoDTO
    {
        $request = new GetFileRequest($fileId);
        $response = $this->client->sendRequest($request);

        if (!$response['ok']) {
            return null;
        }

        $result = $response['result'];

        return new FileInfoDTO(
            fileId: $result['file_id'],
            fileUniqueId: $result['file_unique_id'],
            fileSize: $result['file_size'],
            filePath: $result['file_path'],
        );
    }
}

<?php

namespace App\Services\Telegram;

use App\Services\Telegram\DTO\TelegramRequestDTO;
use Psr\SimpleCache\InvalidArgumentException;

class TelegramRequestSavingService
{
    /**
     * @param TelegramRequestsCacheService $telegramRequestsCacheService
     */
    public function __construct(
        private readonly TelegramRequestsCacheService $telegramRequestsCacheService
    ) {
    }

    /**
     * @param string $mediaGroupId
     * @param TelegramRequestDTO $request
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public function saveByMediaGroupId(string $mediaGroupId, TelegramRequestDTO $request): void
    {
        $message = $request->getMessage();
        if ($message === null) {
            throw new \InvalidArgumentException('Invalid request');
        }

        $requests = $this->telegramRequestsCacheService->get($mediaGroupId) ?? [];
        $requests[] = $request;

        $this->telegramRequestsCacheService->set($mediaGroupId, ...$requests);
    }
}

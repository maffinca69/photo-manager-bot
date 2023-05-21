<?php

namespace App\Jobs;

use App\Infrastructure\Telegram\Client\Exception\TelegramHttpClientException;
use App\Services\Mutex\MutexService;
use App\Services\Telegram\Assembler\MediaRequestDTOAssembler;
use App\Services\Telegram\TelegramRequestsCacheService;
use App\Services\Telegram\TelegramDocumentsPublishingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psr\SimpleCache\InvalidArgumentException;

class RequestsMergingJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private const WAIT_SECONDS = 2;

    /**
     * Create a new job instance.
     *
     * @param int $mediaGroupId
     */
    public function __construct(private readonly int $mediaGroupId) {
    }

    /**
     * Execute the job.
     *
     * @param TelegramRequestsCacheService $requestsForMergingCacheService
     * @param MediaRequestDTOAssembler $requestDTOAssembler
     * @param TelegramDocumentsPublishingService $telegramDocumentsPublishingService
     * @param MutexService $mutexService
     * @return void
     * @throws InvalidArgumentException
     * @throws TelegramHttpClientException
     */
    public function handle(
        TelegramRequestsCacheService       $requestsForMergingCacheService,
        MediaRequestDTOAssembler           $requestDTOAssembler,
        TelegramDocumentsPublishingService $telegramDocumentsPublishingService,
        MutexService                       $mutexService
    ) {
        sleep(self::WAIT_SECONDS);
        $requests = $requestsForMergingCacheService->get($this->mediaGroupId) ?? [];
        $requestDTO = $requestDTOAssembler->create(...$requests);

        $telegramDocumentsPublishingService->publish($requestDTO);

        $mutexService->unlockProcess($this->mediaGroupId);
    }
}

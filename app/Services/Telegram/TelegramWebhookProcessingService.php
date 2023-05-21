<?php

namespace App\Services\Telegram;

use App\Jobs\RequestsMergingJob;
use App\Services\Mutex\MutexService;
use App\Services\Telegram\DTO\TelegramRequestDTO;
use App\Services\Telegram\Specification\IsPhotoDocumentSpecification;
use Illuminate\Support\Facades\Log;
use Psr\SimpleCache\InvalidArgumentException;

class TelegramWebhookProcessingService
{
    private const LOCK_PROCESS_TTL = 10;

    /**
     * @param TelegramRequestSavingService $telegramRequestSavingService
     * @param MutexService $mutexService
     * @param IsPhotoDocumentSpecification $photoDocumentSpecification
     */
    public function __construct(
        private readonly TelegramRequestSavingService $telegramRequestSavingService,
        private readonly MutexService $mutexService,
        private readonly IsPhotoDocumentSpecification $photoDocumentSpecification
    ) {
    }

    /**
     * @param TelegramRequestDTO $requestDTO
     * @return void
     * @throws InvalidArgumentException
     */
    public function process(TelegramRequestDTO $requestDTO): void
    {
        $document = $requestDTO?->getMessage()?->getDocument();
        if ($document === null) {
            Log::info('Not supported. Only documents');
            return;
        }

        $senderChat = $requestDTO?->getMessage()?->getSenderChat();
        if ($senderChat === null) {
            Log::info('Not supported. Work only in channels');
            return;
        }

        if (!$this->photoDocumentSpecification->isSatisfiedBy($document)) {
            Log::info("Invalid mime-type [{$document->getMimeType()}] - skip");
            return;
        }

        $mediaGroupId = $requestDTO->getMessage()->getMediaGroupId() ?? $requestDTO->getMessage()->getId();
        $this->telegramRequestSavingService->saveByMediaGroupId($mediaGroupId, $requestDTO);

        if ($this->mutexService->isProcessLock($mediaGroupId)) {
            return;
        }

        dispatch(new RequestsMergingJob($mediaGroupId));
        $this->mutexService->lockProcess($mediaGroupId, self::LOCK_PROCESS_TTL);
    }
}

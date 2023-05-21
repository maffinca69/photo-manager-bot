<?php

namespace App\Services\Telegram\Assembler;

use App\Services\Telegram\DTO\MediaGroupRequestDTO;
use App\Services\Telegram\DTO\TelegramRequestDTO;

class MediaRequestDTOAssembler
{
    /**
     * @param TelegramRequestDTO ...$requests
     * @return MediaGroupRequestDTO
     */
    public function create(TelegramRequestDTO ...$requests): MediaGroupRequestDTO
    {
        $firstRequest = reset($requests);
        $chatId = $firstRequest->getMessage()->getChat()->getId();
        $chatUsername = $firstRequest->getMessage()->getChat()->getUsername();
        $sourceMessageId = $firstRequest->getMessage()->getId();

        $files = [];
        $caption = null;
        $captionEntities = null;

        foreach ($requests as $request) {
            $document = $request->getMessage()->getDocument();
            $files[] = $document->getFileId();

            if ($caption === null) {
                $captionEntities = $request->getMessage()->getCaptionEntities();
                $caption = $request->getMessage()->getCaption();
            }
        }


        return new MediaGroupRequestDTO(
            $chatId,
            $files,
            $caption,
            $captionEntities,
            $chatUsername,
            $sourceMessageId
        );
    }
}

<?php

namespace App\Http\Request\Assembler\Telegram;

use App\Services\Telegram\DTO\MessageDTO;

class MessageDTOAssembler
{
    /**
     * @param ChatDTOAssembler $chatDTOAssembler
     * @param FromDTOAssembler $fromDTOAssembler
     * @param DocumentDTOAssembler $documentDTOAssembler
     * @param SenderChatDTOAssembler $senderChatDTOAssembler
     */
    public function __construct(
        private readonly ChatDTOAssembler $chatDTOAssembler,
        private readonly FromDTOAssembler $fromDTOAssembler,
        private readonly DocumentDTOAssembler $documentDTOAssembler,
        private readonly SenderChatDTOAssembler $senderChatDTOAssembler,
    ) {
    }

    /**
     * @param array $messageParams
     * @return MessageDTO
     */
    public function create(array $messageParams): MessageDTO
    {
        $date = (new \DateTimeImmutable())->setTimestamp($messageParams['date']);

        $chat = $this->chatDTOAssembler->create($messageParams['chat'] ?? []);

        if (isset($messageParams['from'])) {
            $from = $this->fromDTOAssembler->create($messageParams['from']);
        }

        if (isset($messageParams['sender_chat'])) {
            $senderChat = $this->senderChatDTOAssembler->create($messageParams['sender_chat']);
        }

        $documentDTO = isset($messageParams['document']) ? $this->documentDTOAssembler->create($messageParams['document']) : null;
        $mediaGroupId = $messageParams['media_group_id'] ?? null;
        $caption = $messageParams['caption'] ?? null;
        $captionEntities = $messageParams['caption_entities'] ?? null;

        return new MessageDTO(
            id: $messageParams['message_id'],
            date: $date,
            chat: $chat,
            from: $from ?? null,
            senderChat: $senderChat ?? null,
            document: $documentDTO,
            mediaGroupId: $mediaGroupId,
            caption: $caption,
            captionEntities: $captionEntities
        );
    }
}

<?php

namespace App\Services\Telegram\DTO;

class MessageDTO
{
    /**
     * @param int $id
     * @param \DateTimeInterface $date
     * @param ChatDTO $chat
     * @param FromDTO|null $from
     * @param SenderChatDTO|null $senderChat
     * @param DocumentDTO|null $document
     * @param string|null $mediaGroupId
     * @param string|null $caption
     * @param array|null $captionEntities
     */
    public function __construct(
        private readonly int $id,
        private readonly \DateTimeInterface $date,
        private readonly ChatDTO $chat,
        private readonly ?FromDTO $from = null,
        private readonly ?SenderChatDTO $senderChat = null,
        private readonly ?DocumentDTO $document = null,
        private readonly ?string $mediaGroupId = null,
        private readonly ?string $caption = null,
        private readonly ?array $captionEntities = null,
    ) {
    }

    /**
     * @return SenderChatDTO|null
     */
    public function getSenderChat(): ?SenderChatDTO
    {
        return $this->senderChat;
    }

    /**
     * @return FromDTO|null
     */
    public function getFrom(): ?FromDTO
    {
        return $this->from;
    }

    /**
     * @return array|null
     */
    public function getCaptionEntities(): ?array
    {
        return $this->captionEntities;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @return string|null
     */
    public function getMediaGroupId(): ?string
    {
        return $this->mediaGroupId;
    }

    /**
     * @return DocumentDTO|null
     */
    public function getDocument(): ?DocumentDTO
    {
        return $this->document;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return ChatDTO
     */
    public function getChat(): ChatDTO
    {
        return $this->chat;
    }
}

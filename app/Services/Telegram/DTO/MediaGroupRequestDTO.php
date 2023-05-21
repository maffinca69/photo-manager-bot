<?php

namespace App\Services\Telegram\DTO;

class MediaGroupRequestDTO
{
    /**
     * @param int $chatId
     * @param array<int, string> $files
     * @param string|null $caption
     * @param array|null $captionEntities
     * @param string|null $chatUsername
     * @param int|null $sourceMessageId
     */
    public function __construct(
        private readonly int $chatId,
        private readonly array $files,
        private readonly ?string $caption = null,
        private readonly ?array $captionEntities = null,
        private readonly ?string $chatUsername = null,
        private readonly ?int $sourceMessageId = null,
    ) {
    }

    /**
     * @return int|null
     */
    public function getSourceMessageId(): ?int
    {
        return $this->sourceMessageId;
    }

    /**
     * @return string|null
     */
    public function getChatUsername(): ?string
    {
        return $this->chatUsername;
    }

    /**
     * @return array|null
     */
    public function getCaptionEntities(): ?array
    {
        return $this->captionEntities;
    }

    /**
     * @return int
     */
    public function getChatId(): int
    {
        return $this->chatId;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @return array<int, string>
     */
    public function getFiles(): array
    {
        return $this->files;
    }
}

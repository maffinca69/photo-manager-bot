<?php

namespace App\Services\Telegram\DTO;

class SenderChatDTO
{
    /**
     * @param int $id
     * @param string $title
     * @param string $type
     * @param string|null $username
     */
    public function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $type,
        private readonly ?string $username = null,
    ) {
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}

<?php

namespace App\Services\Telegram\DTO;

class TelegramRequestDTO
{
    /**
     * @param MessageDTO|null $message
     */
    public function __construct(
        private readonly ?MessageDTO $message
    ) {
    }

    /**
     * @return MessageDTO|null
     */
    public function getMessage(): ?MessageDTO
    {
        return $this->message;
    }
}

<?php

namespace App\Http\Request\Assembler\Telegram;

use App\Services\Telegram\DTO\ChatDTO;

class ChatDTOAssembler
{
    /**
     * @param array $chatParams
     * @return ChatDTO
     */
    public function create(array $chatParams): ChatDTO
    {
        return new ChatDTO(
            id: $chatParams['id'],
            firstName: $chatParams['first_name'] ?? null,
            lastName: $chatParams['last_name'] ?? null,
            username: $chatParams['username'] ?? null,
            type: $chatParams['type'],
            title: $chatParams['title'] ?? null,
        );
    }
}

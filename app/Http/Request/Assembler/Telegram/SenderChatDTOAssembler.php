<?php

namespace App\Http\Request\Assembler\Telegram;

use App\Services\Telegram\DTO\SenderChatDTO;

class SenderChatDTOAssembler
{
    /**
     * @param array $senderChatParams
     * @return SenderChatDTO
     */
    public function create(array $senderChatParams): SenderChatDTO
    {
        return new SenderChatDTO(
            id: $senderChatParams['id'],
            title: $senderChatParams['title'],
            type: $senderChatParams['type'],
            username: $senderChatParams['username'] ?? null,
        );
    }
}

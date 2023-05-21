<?php

namespace App\Http\Request\Assembler\Telegram;

use App\Services\Telegram\DTO\FromDTO;

class FromDTOAssembler
{
    /**
     * @param array $fromParams
     * @return FromDTO
     */
    public function create(array $fromParams): FromDTO
    {
        return new FromDTO(
            id: $fromParams['id'],
            firstName: $fromParams['first_name'],
            languageCode: $fromParams['language_code'],
            lastName: $fromParams['last_name'] ?? null,
            username: $fromParams['username'] ?? null,
        );
    }
}

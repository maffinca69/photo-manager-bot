<?php

namespace App\Http\Request\Assembler\Telegram;

use App\Services\Telegram\DTO\FileDTO;

class FileDTOAssembler
{
    /**
     * @param array $fileParams
     * @return FileDTO
     */
    public function create(array $fileParams): FileDTO
    {
        return new FileDTO(
            fileId: $fileParams['file_id'],
            fileUniqueId: $fileParams['file_unique_id'],
            fileSize: $fileParams['file_size'],
            width: $fileParams['width'],
            height: $fileParams['height'],
        );
    }
}

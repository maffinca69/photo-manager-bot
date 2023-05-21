<?php

namespace App\Http\Request\Assembler\Telegram;

use App\Services\Telegram\DTO\DocumentDTO;

class DocumentDTOAssembler
{
    /**
     * @param FileDTOAssembler $fileDTOAssembler
     */
    public function __construct(
        private readonly FileDTOAssembler $fileDTOAssembler
    ) {
    }

    /**
     * @param array $documentParams
     * @return DocumentDTO
     */
    public function create(array $documentParams): DocumentDTO
    {
        $thumb = $this->fileDTOAssembler->create($documentParams['thumb']);
        $thumbnail = $this->fileDTOAssembler->create($documentParams['thumbnail']);

        return new DocumentDTO(
            filename: $documentParams['file_name'],
            mimeType: $documentParams['mime_type'],
            fileId: $documentParams['file_id'],
            fileUniqueId: $documentParams['file_unique_id'],
            fileSize: $documentParams['file_size'],
            thumb: $thumb,
            thumbnail: $thumbnail
        );
    }
}

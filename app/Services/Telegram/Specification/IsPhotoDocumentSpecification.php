<?php

namespace App\Services\Telegram\Specification;

use App\Services\Telegram\DTO\DocumentDTO;

class IsPhotoDocumentSpecification
{
    private const IMAGE_MIME_TYPES = [
        DocumentDTO::MIME_TYPE_JPEG => true,
        DocumentDTO::MIME_TYPE_PNG => true,
        DocumentDTO::MIME_TYPE_HEIC => true,
    ];

    /**
     * @param DocumentDTO $document
     * @return bool
     */
    public function isSatisfiedBy(DocumentDTO $document): bool
    {
        return self::IMAGE_MIME_TYPES[$document->getMimeType()];
    }
}

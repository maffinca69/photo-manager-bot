<?php

namespace App\Services\Telegram\DTO;

class DocumentDTO
{
    public const MIME_TYPE_JPEG = 'image/jpeg';
    public const MIME_TYPE_PNG = 'image/png';
    public const MIME_TYPE_HEIC = 'image/heic';

    /**
     * @param string $filename
     * @param string $mimeType
     * @param string $fileId
     * @param string $fileUniqueId
     * @param int $fileSize
     * @param FileDTO $thumb
     * @param FileDTO $thumbnail
     */
    public function __construct(
        private readonly string $filename,
        private readonly string $mimeType,
        private readonly string $fileId,
        private readonly string $fileUniqueId,
        private readonly int $fileSize,
        private readonly FileDTO $thumb,
        private readonly FileDTO $thumbnail,
    ) {
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return string
     */
    public function getFileId(): string
    {
        return $this->fileId;
    }

    /**
     * @return string
     */
    public function getFileUniqueId(): string
    {
        return $this->fileUniqueId;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * @return FileDTO
     */
    public function getThumb(): FileDTO
    {
        return $this->thumb;
    }

    /**
     * @return FileDTO
     */
    public function getThumbnail(): FileDTO
    {
        return $this->thumbnail;
    }
}

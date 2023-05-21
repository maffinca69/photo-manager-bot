<?php

namespace App\Services\Telegram\DTO;

class FileDTO
{
    /**
     * @param string $fileId
     * @param string $fileUniqueId
     * @param int $fileSize
     * @param int $width
     * @param int $height
     */
    public function __construct(
        private readonly string $fileId,
        private readonly string $fileUniqueId,
        private readonly int $fileSize,
        private readonly int $width,
        private readonly int $height,
    ) {
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
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }
}

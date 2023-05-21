<?php

namespace App\Services\Telegram\DTO;

class FileInfoDTO
{
    /**
     * @param string $fileId
     * @param string $fileUniqueId
     * @param int $fileSize
     * @param string $filePath
     */
    public function __construct(
        private readonly string $fileId,
        private readonly string $fileUniqueId,
        private readonly int $fileSize,
        private readonly string $filePath,
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
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }
}

<?php

namespace App\Services\Telegram\Hydrator;

use App\Infrastructure\Config\ConfigService;
use App\Infrastructure\Telegram\Client\Exception\TelegramHttpClientException;
use App\Services\Telegram\DTO\FileInfoDTO;
use App\Services\Telegram\DTO\MediaGroupRequestDTO;
use App\Services\Telegram\File\FileInfoGettingService;
use App\Services\Telegram\Formatter\ChannelMessageUrlFormatter;

class MediaPhotoHydrator
{
    private const TYPE = 'photo';
    private const BASE_URL = 'https://api.telegram.org/file/bot%s/%s';

    /**
     * @param FileInfoGettingService $fileInfoGettingService
     * @param ConfigService $configService
     * @param CaptionPreparingService $captionPreparingService
     * @param ChannelMessageUrlFormatter $channelMessageUrlFormatter
     */
    public function __construct(
        private readonly FileInfoGettingService $fileInfoGettingService,
        private readonly ConfigService $configService,
        private readonly CaptionPreparingService $captionPreparingService,
        private readonly ChannelMessageUrlFormatter $channelMessageUrlFormatter
    ) {
    }

    /**
     * @param MediaGroupRequestDTO $requestDTO
     * @return array
     * @throws TelegramHttpClientException
     */
    public function extract(MediaGroupRequestDTO $requestDTO): array
    {
        $result = [];

        foreach ($requestDTO->getFiles() as $file) {
            $fileInfo = $this->fileInfoGettingService->get($file);

            $params = [
                'type' => self::TYPE,
                'media' => $this->getUrl($fileInfo),
            ];

            $caption = $requestDTO->getCaption();
            if (empty($result)) {
                $caption = $this->captionPreparingService->prepareCaption($caption ?? '');
                $sourceUrl = $this->channelMessageUrlFormatter->format($requestDTO->getChatUsername(), $requestDTO->getSourceMessageId());
                $preparedEntities = $this->captionPreparingService->prepareCaptionEntities($caption, $sourceUrl);

                $entities = $requestDTO->getCaptionEntities() ?? [];
                $entities[] = $preparedEntities;

                $params['caption'] = $caption;
                $params['caption_entities'] = $entities;
            }

            $result[] = $params;
        }

        return $result;
    }

    /**
     * @param FileInfoDTO $fileInfo
     * @return string
     */
    private function getUrl(FileInfoDTO $fileInfo): string
    {
        $config = $this->configService->get('telegram-client');
        $token = $config['bot_token'];
        $proxyUrl = $config['proxy_image_url'];

        $url = sprintf(self::BASE_URL, $token, $fileInfo->getFilePath());
        return $proxyUrl . '?' .http_build_query([
            'url' => $url,
        ]);
    }
}

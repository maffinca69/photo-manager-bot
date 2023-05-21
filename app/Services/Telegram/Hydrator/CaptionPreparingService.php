<?php

namespace App\Services\Telegram\Hydrator;

class CaptionPreparingService
{
    private const SOURCE = 'Файлы';

    /**
     * @param string $caption
     * @return string
     */
    public function prepareCaption(string $caption): string
    {
        return trim($caption . PHP_EOL . PHP_EOL . self::SOURCE);
    }

    /**
     * @param string $preparedCaption
     * @param string $sourceUrl
     * @return array
     */
    public function prepareCaptionEntities(string $preparedCaption, string $sourceUrl): array
    {
        $length = mb_strlen(self::SOURCE);
        $offset = mb_strpos($preparedCaption, self::SOURCE);

        if ($offset === false) {
            throw new \RuntimeException("Invalid preparedCaption [$preparedCaption]");
        }

        return [
            'offset' => $offset,
            'length' => $length,
            'type' => 'text_link',
            'url' => $sourceUrl,
        ];
    }
}

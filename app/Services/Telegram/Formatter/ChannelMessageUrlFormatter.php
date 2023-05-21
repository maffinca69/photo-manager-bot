<?php

namespace App\Services\Telegram\Formatter;

class ChannelMessageUrlFormatter
{
    private const BASE_URL = 'https://t.me/%s/%s';

    /**
     * @param string $username
     * @param int $messageId
     * @return string
     */
    public function format(string $username, int $messageId): string
    {
        return sprintf(self::BASE_URL, $username, $messageId);
    }
}

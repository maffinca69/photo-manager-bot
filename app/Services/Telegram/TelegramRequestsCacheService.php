<?php

namespace App\Services\Telegram;

use App\Services\Telegram\DTO\TelegramRequestDTO;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class TelegramRequestsCacheService
{
    private const CACHE_PREFIX = 'user_';
    private const CACHE_TTL = 10; // 2 seconds

    /**
     * @param CacheInterface $cache
     */
    public function __construct(
        private readonly CacheInterface $cache
    ) {
    }

    /**
     * @param int $mediaGroupId
     * @return array<TelegramRequestDTO>|null
     * @throws InvalidArgumentException
     */
    public function get(int $mediaGroupId): ?array
    {
        return $this->cache->get(self::CACHE_PREFIX . $mediaGroupId);
    }

    /**
     * @param int $mediaGroupId
     * @param TelegramRequestDTO ...$requests
     * @return bool
     * @throws InvalidArgumentException
     */
    public function set(int $mediaGroupId, TelegramRequestDTO ...$requests): bool
    {
        return $this->cache->set(self::CACHE_PREFIX . $mediaGroupId, $requests, self::CACHE_TTL);
    }
}

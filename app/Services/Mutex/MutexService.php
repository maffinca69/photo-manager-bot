<?php

namespace App\Services\Mutex;

use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class MutexService
{
    /**
     * @param CacheInterface $cache
     */
    public function __construct(
        private readonly CacheInterface $cache
    ) {
    }

    /**
     * @param string $processName
     * @param int $ttl seconds
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public function lockProcess(string $processName, int $ttl): void
    {
        if ($this->isProcessLock($processName)) {
            return;
        }

        $this->cache->set($processName, time(), $ttl);
    }

    /**
     * @param string $processName
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public function unlockProcess(string $processName): void
    {
        $this->cache->delete($processName);
    }

    /**
     * @param string $processName
     *
     * @return bool
     * @throws InvalidArgumentException
     */
    public function isProcessLock(string $processName): bool
    {
        return $this->cache->has($processName);
    }
}

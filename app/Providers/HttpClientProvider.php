<?php

namespace App\Providers;

use App\Infrastructure\Config\ConfigService;
use App\Infrastructure\Telegram\Client\HttpClient as TelegramHttpClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;
use Psr\Http\Client\ClientInterface;

class HttpClientProvider extends ServiceProvider
{
    private const TELEGRAM_HTTP_CLIENT = 'telegram-client';

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ClientInterface::class, static function (Application $app) {
            return new Client();
        });

        $this->app->bind(TelegramHttpClient::class, static function (Application $app) {
            /** @var ConfigService $configService */
            $configService = $app->get(ConfigService::class);
            $config = $configService->get(self::TELEGRAM_HTTP_CLIENT);

            $baseUrl = $config['base_url'] ?? null;
            if ($baseUrl === null) {
                throw new \InvalidArgumentException('Invalid config ' . self::TELEGRAM_HTTP_CLIENT . ': no valid \'base_url\' defined');
            }

            $botToken = $config['bot_token'] ?? null;
            if ($botToken === null) {
                throw new \InvalidArgumentException('Invalid config ' . self::TELEGRAM_HTTP_CLIENT . ': no valid \'bot_token\' defined');
            }

            $baseUrl .= $botToken;
            return new TelegramHttpClient(
                $app->get(ClientInterface::class),
                $baseUrl
            );
        });
    }
}

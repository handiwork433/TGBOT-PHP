<?php

namespace App\Providers;

use App\Services\CryptoPay\InvoiceService;
use App\Services\Telegram\TelegramClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TelegramClient::class, function ($app) {
            return new TelegramClient(config('services.telegram.bot_token'));
        });

        $this->app->singleton(InvoiceService::class, function ($app) {
            return new InvoiceService(
                config('services.cryptobot.api_token'),
                config('services.cryptobot.currency'),
                config('services.cryptobot.webhook_secret'),
            );
        });
    }

    public function boot(): void
    {
        //
    }
}

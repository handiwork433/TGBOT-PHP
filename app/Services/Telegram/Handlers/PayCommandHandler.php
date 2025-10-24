<?php

namespace App\Services\Telegram\Handlers;

use App\Models\Plan;
use App\Models\User;
use App\Services\CryptoPay\InvoiceService;
use App\Services\Telegram\TelegramClient;
use Illuminate\Support\Facades\Lang;

class PayCommandHandler implements CommandHandlerInterface
{
    public function __construct(protected TelegramClient $client, protected InvoiceService $invoiceService)
    {
    }

    public function handle(array $update): void
    {
        $message = $update['message'] ?? [];
        $chatId = $message['chat']['id'] ?? null;

        if (! $chatId) {
            return;
        }

        $user = User::query()->where('tg_user_id', $chatId)->first();

        if (! $user) {
            return;
        }

        $plans = Plan::query()->where('is_active', true)->orderBy('price_usdt')->get();

        $text = $plans->map(fn ($plan) => sprintf('%s — %s USDT за %d дней', $plan->name, $plan->price_usdt, $plan->period_days))->implode("\n");

        $this->client->sendMessage($chatId, $text ?: Lang::get('messages.no_plans', [], $user->locale));
    }
}

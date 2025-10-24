<?php

namespace App\Services\Telegram\Handlers;

use App\Models\Signal;
use App\Models\User;
use App\Services\Telegram\SignalFormatter;
use App\Services\Telegram\TelegramClient;

class LatestCommandHandler implements CommandHandlerInterface
{
    public function __construct(protected TelegramClient $client, protected SignalFormatter $formatter)
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

        $signals = Signal::query()
            ->availableForUser($user)
            ->latest('publish_at')
            ->limit(5)
            ->get();

        if ($signals->isEmpty()) {
            $this->client->sendMessage($chatId, 'Нет доступных сигналов.');

            return;
        }

        foreach ($signals as $signal) {
            $this->client->sendMessage($chatId, $this->formatter->format($signal, $user));
        }
    }
}

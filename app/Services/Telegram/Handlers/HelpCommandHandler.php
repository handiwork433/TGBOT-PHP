<?php

namespace App\Services\Telegram\Handlers;

use App\Services\Telegram\TelegramClient;

class HelpCommandHandler implements CommandHandlerInterface
{
    public function __construct(protected TelegramClient $client)
    {
    }

    public function handle(array $update): void
    {
        $message = $update['message'] ?? [];
        $chatId = $message['chat']['id'] ?? null;

        if (! $chatId) {
            return;
        }

        $help = <<<TEXT
Доступные команды:
/start — регистрация и триал
/pay — выбрать тариф и оплатить
/myplan — информация о подписке
/latest — последние сигналы
/help — помощь
TEXT;

        $this->client->sendMessage($chatId, $help);
    }
}

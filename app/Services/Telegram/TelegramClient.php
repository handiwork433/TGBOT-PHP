<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;

class TelegramClient
{
    public function __construct(protected string $token)
    {
    }

    public function sendMessage(int|string $chatId, string $text, array $extra = []): void
    {
        Http::post($this->endpoint('sendMessage'), array_merge([
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML',
        ], $extra));
    }

    protected function endpoint(string $method): string
    {
        return sprintf('https://api.telegram.org/bot%s/%s', $this->token, $method);
    }
}

<?php

namespace App\Services\Telegram\Handlers;

use App\Models\User;
use App\Services\Telegram\TelegramClient;
use App\Services\Telegram\TrialService;
use Illuminate\Support\Facades\Lang;

class StartCommandHandler implements CommandHandlerInterface
{
    public function __construct(protected TelegramClient $client, protected TrialService $trialService)
    {
    }

    public function handle(array $update): void
    {
        $message = $update['message'] ?? [];
        $chatId = $message['chat']['id'] ?? null;
        $username = $message['from']['username'] ?? null;
        $ref = $this->extractReferral($message['text'] ?? '');

        if (! $chatId) {
            return;
        }

        $user = User::firstOrCreate(
            ['tg_user_id' => $chatId],
            [
                'tg_username' => $username,
                'locale' => config('app.locale'),
                'timezone' => config('app.timezone'),
            ]
        );

        if ($ref) {
            $this->trialService->applyReferral($user, $ref);
        }

        $trialDays = $this->trialService->startTrial($user);

        $this->client->sendMessage(
            $chatId,
            Lang::get('messages.welcome.'.$user->locale, ['trial_days' => $trialDays])
        );
    }

    protected function extractReferral(string $text): ?string
    {
        $parts = explode(' ', trim($text));

        return $parts[1] ?? null;
    }
}

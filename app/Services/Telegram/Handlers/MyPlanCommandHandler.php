<?php

namespace App\Services\Telegram\Handlers;

use App\Models\Subscription;
use App\Models\User;
use App\Services\Telegram\TelegramClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;

class MyPlanCommandHandler implements CommandHandlerInterface
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

        $user = User::query()->where('tg_user_id', $chatId)->first();

        if (! $user) {
            return;
        }

        $subscription = Subscription::query()
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->orderByDesc('end_at')
            ->first();

        if (! $subscription) {
            $this->client->sendMessage($chatId, Lang::get('messages.no_active_subscription', [], $user->locale));

            return;
        }

        $endAt = Carbon::parse($subscription->end_at);
        $daysLeft = now($user->timezone)->diffInDays($endAt, false);

        $text = Lang::get('messages.subscription_status', [
            'plan' => $subscription->plan->name,
            'date' => $endAt->timezone($user->timezone)->toDateTimeString(),
            'days_left' => $daysLeft,
        ], $user->locale);

        $this->client->sendMessage($chatId, $text);
    }
}

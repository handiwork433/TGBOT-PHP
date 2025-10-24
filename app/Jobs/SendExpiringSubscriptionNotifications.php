<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Services\Telegram\TelegramClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class SendExpiringSubscriptionNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(TelegramClient $client): void
    {
        $subscriptions = Subscription::query()
            ->where('status', 'active')
            ->whereBetween('end_at', [now(), now()->addHours(24)])
            ->get();

        foreach ($subscriptions as $subscription) {
            $user = $subscription->user;
            if (! $user || ! $user->tg_user_id) {
                continue;
            }

            $client->sendMessage(
                $user->tg_user_id,
                Lang::get('messages.subscription_ending.'.$user->locale, ['hours_left' => 24], $user->locale)
            );
        }
    }
}

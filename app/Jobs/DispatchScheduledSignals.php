<?php

namespace App\Jobs;

use App\Models\Signal;
use App\Services\Telegram\TelegramClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DispatchScheduledSignals implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(TelegramClient $client): void
    {
        $signals = Signal::query()
            ->whereNull('publish_at')
            ->orWhere('publish_at', '<=', now())
            ->get();

        foreach ($signals as $signal) {
            Log::info('signal.dispatch', ['id' => $signal->id]);
            // placeholder broadcast
        }
    }
}

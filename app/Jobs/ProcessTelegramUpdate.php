<?php

namespace App\Jobs;

use App\Services\Telegram\CommandRouter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTelegramUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected array $payload)
    {
    }

    public function handle(CommandRouter $router): void
    {
        $router->handle($this->payload);
    }
}

<?php

namespace App\Services\Telegram;

use App\Services\Telegram\Handlers\HelpCommandHandler;
use App\Services\Telegram\Handlers\LatestCommandHandler;
use App\Services\Telegram\Handlers\MyPlanCommandHandler;
use App\Services\Telegram\Handlers\PayCommandHandler;
use App\Services\Telegram\Handlers\StartCommandHandler;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

class CommandRouter
{
    /** @var array<string, CommandHandlerInterface> */
    protected array $handlers = [];

    public function __construct(
        StartCommandHandler $start,
        PayCommandHandler $pay,
        MyPlanCommandHandler $myPlan,
        LatestCommandHandler $latest,
        HelpCommandHandler $help,
        Dispatcher $events
    ) {
        $this->handlers = [
            'start' => $start,
            'pay' => $pay,
            'myplan' => $myPlan,
            'latest' => $latest,
            'help' => $help,
        ];
    }

    public function handle(array $update): void
    {
        $command = $this->extractCommand($update);

        if ($command && isset($this->handlers[$command])) {
            $this->handlers[$command]->handle($update);

            return;
        }

        Log::info('telegram_unhandled_update', $update);
    }

    protected function extractCommand(array $update): ?string
    {
        $message = $update['message'] ?? $update['callback_query']['message'] ?? null;
        $text = $message['text'] ?? null;

        if (! $text) {
            return null;
        }

        if (str_starts_with($text, '/')) {
            return strtolower(trim(explode(' ', substr($text, 1))[0]));
        }

        return null;
    }
}

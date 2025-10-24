<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTelegramUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BotWebhookController extends Controller
{
    public function handle(Request $request): Response
    {
        $payload = $request->all();

        Log::channel('daily')->info('telegram_webhook', $payload);

        ProcessTelegramUpdate::dispatch($payload);

        return response()->noContent();
    }
}

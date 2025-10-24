<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCryptoWebhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CryptoWebhookController extends Controller
{
    public function handle(Request $request): Response
    {
        $payload = $request->all();

        Log::channel('daily')->info('cryptobot_webhook', $payload);

        ProcessCryptoWebhook::dispatch($payload);

        return response()->noContent();
    }
}

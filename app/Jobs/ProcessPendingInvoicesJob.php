<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Services\CryptoPay\InvoiceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProcessPendingInvoicesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(InvoiceService $service): void
    {
        $payments = Payment::query()->where('status', 'pending')->latest()->limit(50)->get();

        foreach ($payments as $payment) {
            $response = Http::withToken(config('services.cryptobot.api_token'))
                ->post('https://pay.crypt.bot/api/getInvoice', [
                    'invoice_id' => $payment->invoice_id,
                ])->json('result');

            if (! $response) {
                continue;
            }

            if (($response['status'] ?? 'pending') === 'paid') {
                $service->handleWebhook([
                    'invoice_id' => $payment->invoice_id,
                    'status' => 'paid',
                    'tx_hash' => $response['paid_crypto_hash'] ?? null,
                    'signature' => hash_hmac('sha256', json_encode($response), config('services.cryptobot.webhook_secret')),
                ]);
            }
        }
    }
}

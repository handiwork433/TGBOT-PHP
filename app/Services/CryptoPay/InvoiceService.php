<?php

namespace App\Services\CryptoPay;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class InvoiceService
{
    public function __construct(protected string $token, protected string $currency, protected string $webhookSecret)
    {
    }

    public function createInvoice(User $user, Plan $plan): Payment
    {
        $payload = implode('|', [
            $user->id,
            $plan->id,
            Str::uuid()->toString(),
        ]);

        $signature = hash_hmac('sha256', $payload, $this->webhookSecret);

        $response = Http::withToken($this->token)->post('https://pay.crypt.bot/api/createInvoice', [
            'amount' => $plan->price_usdt,
            'currency_type' => 'crypto',
            'currency' => $this->currency,
            'description' => sprintf('Subscription %s', $plan->name),
            'payload' => $payload.'|'.$signature,
            'expires_in' => 900,
            'allow_comments' => false,
            'allow_anonymous' => false,
        ])->json('result', []);

        return Payment::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'amount' => $plan->price_usdt,
            'currency' => $this->currency,
            'status' => 'pending',
            'provider' => 'CryptoBot',
            'invoice_id' => $response['invoice_id'] ?? null,
            'payload_sig' => $signature,
        ]);
    }

    public function handleWebhook(array $payload): void
    {
        $signature = hash_hmac('sha256', json_encode($payload), $this->webhookSecret);

        if (($payload['signature'] ?? null) !== $signature) {
            Log::warning('cryptobot.invalid_signature', $payload);

            return;
        }

        $invoiceId = $payload['invoice_id'] ?? null;

        if (! $invoiceId) {
            return;
        }

        $payment = Payment::query()->where('invoice_id', $invoiceId)->first();

        if (! $payment) {
            Log::warning('cryptobot.unknown_invoice', $payload);

            return;
        }

        if ($payment->status === 'paid') {
            return;
        }

        DB::transaction(function () use ($payment, $payload) {
            $status = $payload['status'] ?? 'pending';
            $payment->update([
                'status' => $status === 'paid' ? 'paid' : $status,
                'tx_hash' => $payload['tx_hash'] ?? null,
                'paid_at' => $status === 'paid' ? now() : null,
            ]);

            if ($status === 'paid') {
                $this->activateSubscription($payment);
            }
        });
    }

    protected function activateSubscription(Payment $payment): void
    {
        $plan = $payment->plan;
        $user = $payment->user;

        $currentEnd = Subscription::query()
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->max('end_at');

        $start = now();
        $end = now()->addDays($plan->period_days);

        if ($currentEnd && $currentEnd > now()) {
            $start = now();
            $end = now()->parse($currentEnd)->addDays($plan->period_days);
        }

        Subscription::updateOrCreate([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
        ], [
            'start_at' => $start,
            'end_at' => $end,
            'status' => 'active',
            'source' => 'paid',
        ]);
    }
}

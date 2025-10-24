<?php

namespace App\Jobs;

use App\Services\CryptoPay\InvoiceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCryptoWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected array $payload)
    {
    }

    public function handle(InvoiceService $service): void
    {
        $service->handleWebhook($this->payload);
    }
}

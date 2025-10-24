<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPendingInvoicesJob;
use Illuminate\Console\Command;

class ProcessPendingInvoices extends Command
{
    protected $signature = 'payments:check-pending';
    protected $description = 'Check pending CryptoBot invoices';

    public function handle(): int
    {
        ProcessPendingInvoicesJob::dispatch();

        $this->info('Pending invoices check dispatched');

        return self::SUCCESS;
    }
}

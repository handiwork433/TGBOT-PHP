<?php

namespace App\Console\Commands;

use App\Jobs\DispatchScheduledSignals;
use Illuminate\Console\Command;

class SendScheduledSignals extends Command
{
    protected $signature = 'signals:send-scheduled';
    protected $description = 'Dispatch jobs to send scheduled signals';

    public function handle(): int
    {
        DispatchScheduledSignals::dispatch();

        $this->info('Scheduled signals dispatched');

        return self::SUCCESS;
    }
}

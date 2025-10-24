<?php

namespace App\Console;

use App\Console\Commands\ProcessPendingInvoices;
use App\Console\Commands\SendExpiringNotifications;
use App\Console\Commands\SendScheduledSignals;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('signals:send-scheduled')->everyMinute();
        $schedule->command('subscriptions:notify-expiring')->everyFiveMinutes();
        $schedule->command('payments:check-pending')->everyTenMinutes();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}

<?php

namespace App\Console\Commands;

use App\Jobs\SendExpiringSubscriptionNotifications;
use Illuminate\Console\Command;

class SendExpiringNotifications extends Command
{
    protected $signature = 'subscriptions:notify-expiring';
    protected $description = 'Notify users about expiring trials and subscriptions';

    public function handle(): int
    {
        SendExpiringSubscriptionNotifications::dispatch();

        $this->info('Expiring notifications dispatched');

        return self::SUCCESS;
    }
}

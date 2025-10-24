<?php

namespace Database\Seeders;

use App\Models\Signal;
use App\Models\User;
use Illuminate\Database\Seeder;

class SignalSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->where('is_admin', true)->first();

        if (! $admin) {
            return;
        }

        for ($i = 1; $i <= 5; $i++) {
            Signal::updateOrCreate(['title' => "Demo Signal {$i}"], [
                'content_md' => "## Demo Signal {$i}\nОписание сигнала.",
                'tags' => ['demo', 'signal'],
                'risk_level' => 'medium',
                'expected_margin_pct' => 12.5,
                'legs_json' => [['exchange' => 'Binance', 'action' => 'Buy']],
                'attachments' => [],
                'lang' => 'ru',
                'publish_at' => now()->subDays($i),
                'expires_at' => now()->addDays(7),
                'created_by' => $admin->id,
            ]);
        }
    }
}

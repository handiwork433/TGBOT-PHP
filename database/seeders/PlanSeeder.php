<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::updateOrCreate(['slug' => 'basic'], [
            'name' => 'Basic',
            'period_days' => 30,
            'price_usdt' => 49,
            'is_active' => true,
            'features' => ['signals' => 'Standard access'],
        ]);

        Plan::updateOrCreate(['slug' => 'pro'], [
            'name' => 'Pro',
            'period_days' => 30,
            'price_usdt' => 149,
            'is_active' => true,
            'features' => ['signals' => 'Extended access'],
        ]);
    }
}

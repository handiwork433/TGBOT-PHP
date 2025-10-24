<?php

namespace App\Services\Telegram;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class TrialService
{
    public function startTrial(User $user): int
    {
        $trialDays = (int) Config::get('services.bot.free_trial_days', env('FREE_TRIAL_DAYS', 3));

        $hasTrial = Subscription::query()
            ->where('user_id', $user->id)
            ->where('source', 'trial')
            ->exists();

        if ($hasTrial || $trialDays <= 0) {
            return 0;
        }

        Subscription::create([
            'user_id' => $user->id,
            'plan_id' => null,
            'start_at' => now(),
            'end_at' => Carbon::now()->addDays($trialDays),
            'status' => 'trial',
            'source' => 'trial',
        ]);

        return $trialDays;
    }

    public function applyReferral(User $user, string $ref): void
    {
        if ($user->referred_by) {
            return;
        }

        $referrer = User::query()->where('ref_code', $ref)->first();

        if (! $referrer) {
            return;
        }

        $user->update(['referred_by' => $referrer->id]);
    }
}

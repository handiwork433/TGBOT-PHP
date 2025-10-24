<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'tg_user_id',
        'tg_username',
        'locale',
        'timezone',
        'ref_code',
        'referred_by',
        'is_banned',
        'is_admin',
    ];

    protected $casts = [
        'is_banned' => 'boolean',
        'is_admin' => 'boolean',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function extendSubscription(int $days, string $source): void
    {
        $subscription = $this->subscriptions()->active()->first();

        if (! $subscription) {
            $subscription = $this->subscriptions()->create([
                'plan_id' => null,
                'start_at' => now(),
                'end_at' => now()->addDays($days),
                'status' => 'active',
                'source' => $source,
            ]);

            return;
        }

        $subscription->update([
            'end_at' => $subscription->end_at->addDays($days),
        ]);
    }
}

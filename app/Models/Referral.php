<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'referrer_user_id',
        'referred_user_id',
        'referred_paid_at',
        'bonus_days_granted',
        'created_at',
    ];

    protected $casts = [
        'referred_paid_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_user_id');
    }

    public function referred(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}

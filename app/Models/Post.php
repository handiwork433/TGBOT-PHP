<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'signal_id',
        'channel',
        'sent_at',
        'delivered_count',
        'read_count',
        'ctr',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'ctr' => 'float',
    ];

    public function signal(): BelongsTo
    {
        return $this->belongsTo(Signal::class);
    }
}

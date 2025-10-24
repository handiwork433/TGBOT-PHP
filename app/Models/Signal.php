<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Signal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content_md',
        'tags',
        'risk_level',
        'expected_margin_pct',
        'legs_json',
        'attachments',
        'lang',
        'audience_filters',
        'publish_at',
        'expires_at',
        'created_by',
    ];

    protected $casts = [
        'tags' => 'array',
        'legs_json' => 'array',
        'attachments' => 'array',
        'audience_filters' => 'array',
        'publish_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function scopeAvailableForUser(Builder $query, User $user): Builder
    {
        return $query->where(function ($builder) use ($user) {
            $builder->whereNull('audience_filters')
                ->orWhereJsonContains('audience_filters->locales', $user->locale);
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}

<?php

namespace App\Services\Telegram;

use App\Models\Signal;
use App\Models\User;
use Illuminate\Support\Facades\Lang;

class SignalFormatter
{
    public function format(Signal $signal, User $user): string
    {
        $tags = collect($signal->tags)->implode(', ');
        $risk = match ($signal->risk_level) {
            'low' => 'низкий',
            'medium' => 'средний',
            'high' => 'высокий',
            default => $signal->risk_level,
        };

        return Lang::get('messages.signal_card.'.$user->locale, [
            'title' => $signal->title,
            'margin' => $signal->expected_margin_pct,
            'risk' => $risk,
            'tags' => $tags,
        ], $user->locale);
    }
}

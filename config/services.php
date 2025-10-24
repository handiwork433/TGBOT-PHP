<?php

return [
    'telegram' => [
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        'bot_username' => env('TELEGRAM_BOT_USERNAME'),
        'admin_user_ids' => array_filter(explode(',', env('TELEGRAM_ADMIN_USER_IDS', ''))),
    ],
    'cryptobot' => [
        'api_token' => env('CRYPTO_PAY_API_TOKEN'),
        'currency' => env('CRYPTO_CURRENCY', 'USDT'),
        'webhook_secret' => env('WEBHOOK_SECRET'),
    ],
    'bot' => [
        'free_trial_days' => env('FREE_TRIAL_DAYS', 3),
        'referral_bonus_days' => env('REFERRAL_BONUS_DAYS', 3),
        'rate_limit_per_min' => env('RATE_LIMIT_PER_MIN', 30),
    ],
];

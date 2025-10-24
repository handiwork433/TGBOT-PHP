<?php

return [
    'name' => env('APP_NAME', 'Arb Alerts'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'https://admin.example.com'),
    'timezone' => env('TIMEZONE', 'Europe/Prague'),
    'locale' => env('LOCALE', 'ru'),
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
];

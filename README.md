# Arb Alerts Platform

Laravel 11 based admin panel and Telegram bot backend for delivering arbitrage trading signals.

## Requirements

- PHP 8.2+
- Composer
- MySQL/MariaDB
- HTTPS enabled web server pointing to `public/`
- Cron every minute running `php artisan schedule:run`

## Setup

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
```

Configure Telegram and CryptoBot webhooks to point to `/bot/webhook` and `/payments/cryptobot/webhook` respectively.

## Testing webhooks locally

Use tools like ngrok to expose local environment. Configure webhook secrets via environment variables.

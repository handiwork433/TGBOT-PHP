<?php

namespace App\Services\Telegram\Handlers;

interface CommandHandlerInterface
{
    public function handle(array $update): void;
}

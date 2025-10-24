<?php

use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdp\UdpSocket;
use Monolog\Formatter\JsonFormatter;

return [
    'default' => env('LOG_CHANNEL', 'stack'),

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily'],
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'info'),
            'days' => 14,
            'tap' => [function ($logger) {
                foreach ($logger->getHandlers() as $handler) {
                    $handler->setFormatter(new JsonFormatter());
                }
            }],
        ],
    ],
];

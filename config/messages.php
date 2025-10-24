<?php

return [
    'welcome' => [
        'ru' => "Привет! Я бот Arb Alerts. Тебе доступен :trial_days-дневный триал. Используй /latest, чтобы посмотреть сигналы. Для полной подписки — /pay. Не является инвест. рекомендацией.",
        'en' => "Hello! I'm the Arb Alerts bot. You have a :trial_days-day trial available. Use /latest to view signals. For full access — /pay. Not financial advice.",
    ],
    'pay_success' => [
        'ru' => "Оплата получена ✅ Подписка :plan активна до :date.",
        'en' => "Payment received ✅ Subscription :plan is active until :date.",
    ],
    'trial_ending' => [
        'ru' => "Триал закончится через :hours_left ч. Продлить подписку: /pay",
        'en' => "Trial ends in :hours_left h. Extend via /pay",
    ],
    'subscription_ending' => [
        'ru' => "Подписка закончится через :hours_left ч. Продлить: /pay",
        'en' => "Subscription expires in :hours_left h. Renew via /pay",
    ],
    'signal_card' => [
        'ru' => ":title\nМаржа: ~:margin% • Риск: :risk\nТеги: :tags",
        'en' => ":title\nMargin: ~:margin% • Risk: :risk\nTags: :tags",
    ],
];

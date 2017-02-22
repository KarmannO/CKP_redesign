<?php
return [
    'admin_panel' => [
        'type' => 2,
        'description' => 'Панель администратора',
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
        'ruleName' => 'userRole',
    ],
    'moderator' => [
        'type' => 1,
        'description' => 'Модератор',
        'ruleName' => 'userRole',
        'children' => [
            'user',
            'admin_panel',
        ],
    ],
    'administrator' => [
        'type' => 1,
        'description' => 'Администратор',
        'ruleName' => 'userRole',
        'children' => [
            'moderator',
        ],
    ],
];

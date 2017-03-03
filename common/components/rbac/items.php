<?php
return [
    'ckp_full_list' => [
        'type' => 2,
        'description' => 'Список всех ЦКП и возможность их редактирования.',
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
        'ruleName' => 'userRole',
    ],
    'moderator' => [
        'type' => 1,
        'description' => 'Администратор ЦКП',
        'ruleName' => 'userRole',
        'children' => [
            'user',
            'ckp_full_list',
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

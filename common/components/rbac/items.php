<?php
return [
    'ckp_full_list' => [
        'type' => 2,
        'description' => 'Возможность просмотра полного списка ЦКП',
    ],
    'is_admin_panel_access' => [
        'type' => 2,
        'description' => 'Доступ к панели администратора',
    ],
    'user_edit_access' => [
        'type' => 2,
        'description' => 'Возможность редактировать личные данные пользователя',
    ],
    'ckp_admin_panel_access' => [
        'type' => 2,
        'description' => 'Доступ к панели администрирования ЦКП',
    ],
    'ckp_my_list' => [
        'type' => 2,
        'description' => 'Возможность просмотра своего списка ЦКП',
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
        'ruleName' => 'userRole',
    ],
    'ckp_moderator' => [
        'type' => 1,
        'description' => 'Модератор ЦКП',
        'ruleName' => 'userRole',
        'children' => [
            'ckp_admin_panel_access',
        ],
    ],
    'ckp_administrator' => [
        'type' => 1,
        'description' => 'Администратор ЦКП',
        'ruleName' => 'userRole',
        'children' => [
            'ckp_moderator',
            'ckp_my_list',
        ],
    ],
    'is_moderator' => [
        'type' => 1,
        'description' => 'Модератор ЦКП',
        'ruleName' => 'userRole',
        'children' => [
            'user',
            'ckp_full_list',
            'is_admin_panel_access',
            'ckp_admin_panel_access',
            'ckp_my_list',
        ],
    ],
    'is_administrator' => [
        'type' => 1,
        'description' => 'Администратор ЦКП',
        'ruleName' => 'userRole',
        'children' => [
            'is_moderator',
            'user',
            'user_edit_access',
        ],
    ],
];

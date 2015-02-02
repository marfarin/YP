<?php
return [
    'dashboard' => [
        'type' => 2,
        'description' => 'Админ панель',
    ],
    'guest' => [
        'type' => 1,
        'description' => 'Гость',
        'ruleName' => 'userRole',
    ],
    'root' => [
        'type' => 1,
        'description' => 'Суперпользователь',
        'ruleName' => 'userRole',
        'children' => [
            'admin',
        ],
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
        'ruleName' => 'userRole',
        'children' => [
            'guest',
        ],
    ],
    'moderator' => [
        'type' => 1,
        'description' => 'Модератор',
        'ruleName' => 'userRole',
        'children' => [
            'user',
            'dashboard',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'ruleName' => 'userRole',
        'children' => [
            'moderator',
        ],
    ],
];

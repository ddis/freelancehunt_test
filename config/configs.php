<?php
return [
    'menu'            => [

        [
            'name'  => 'Главная',
            'icon'  => 'nc-chart-pie-35',
            'route' => '/',
        ],

        [
            'name'  => 'Проекты',
            'icon'  => 'nc-notes',
            'route' => '/projects',
        ],

        [
            'name'  => 'Настройки',
            'icon'  => 'nc-settings-gear-64',
            'route' => '/settings',
        ],
    ],
    'db'              => [
        'driver'   => 'mysql',
        'host'     => '',
        'database' => '',
        'password' => '',
        'user'     => '',
        'charset'  => 'utf8',
    ],
    'API-key'         => '',
    'isInstalled'     => false,
    'skills_category' => [
        0 => '1',
        1 => '86',
        2 => '99',
    ],
    'pagination'      => [
        'onPage' => 10,
    ],
];

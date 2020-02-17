<?php

use Kernel\App;

defined("CORE_PATH") or define("CORE_PATH", __DIR__);

$db = App::getInstance()->get("configManager")->get("db");

return [
'paths'        => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds'      => '%%PHINX_CONFIG_DIR%%/db/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database'        => "development",
        'development'             => [
            'adapter' => 'mysql',
            'host'    => $db['host'],
            'name'    => $db['database'],
            'user'    => $db['user'],
            'pass'    => $db['password'],
            'charset' => $db['charset'],
        ],
    ],
];
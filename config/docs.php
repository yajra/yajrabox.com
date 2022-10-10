<?php

return [
    'username' => 'yajra',
    'versions' => [
        'laravel-auditable' => [
            'master' => 'Master',
            '1.0'    => '1.0',
        ],

        'laravel-acl' => [
            'master' => 'Master',
            '5.0'    => '5.0',
            '4.0'    => '4.0',
            '3.0'    => '3.0',
        ],

        'laravel-datatables' => [
            'master' => 'Master',
            '9.0'    => '9.0',
            '8.0'    => '8.0',
            '7.0'    => '7.0',
            '6.0'    => '6.0',
        ],

        'laravel-oci8' => [
            'master' => 'Master',
            '8.0'    => '8.0',
            '5.3'    => '5.3 - 5.8',
        ],
    ],

    'paths' => [
        'laravel-auditable'  => 'https://raw.githubusercontent.com/yajra/laravel-auditable-docs/',
        'laravel-acl'        => 'https://raw.githubusercontent.com/yajra/laravel-acl-docs/',
        'laravel-oci8'       => 'https://raw.githubusercontent.com/yajra/laravel-oci8-docs/',
        'laravel-datatables' => 'https://raw.githubusercontent.com/yajra/laravel-datatables-docs/',
    ],

    'local_paths' => [
        'laravel-auditable'  => '/Users/yajra/www/yajra/docs/laravel-auditable/',
        'laravel-acl'        => '/Users/yajra/www/yajra/docs/laravel-acl/',
        'laravel-oci8'       => '/Users/yajra/www/yajra/docs/laravel-oci8/',
        'laravel-datatables' => '/Users/yajra/www/yajra/docs/laravel-datatables/',
    ],

    'links' => [
        'laravel-auditable'  => [],
        'laravel-acl'        => [],
        'laravel-oci8'       => [],
        'laravel-datatables' => [
            'datatables' => [
                'title' => 'DataTables.net',
                'icon'  => 'nav-datatables',
                'url'   => 'https://datatables.net',
            ],
        ],
    ],
];

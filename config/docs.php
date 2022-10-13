<?php

return [
    'username' => 'yajra',
    'packages' => [
        'laravel-auditable' => [
            'default' => 'master',
            'versions' => [
                'master' => 'Master',
                '4.0' => '4.0',
                '3.0' => '3.0',
                '2.0' => '2.0',
            ],
        ],

        'laravel-acl' => [
            'default' => 'master',
            'versions' => [
                'master' => 'Master',
                '9.0' => '9.0',
                '6.0' => '6.0',
                '5.0' => '5.0',
                '4.0' => '4.0',
                '3.0' => '3.0',
            ],
        ],

        'laravel-datatables' => [
            'default' => '10.0',
            'versions' => [
                'master' => 'Master',
                '10.0' => '10.0',
                '9.0' => '9.0',
                '8.0' => '8.0',
                '7.0' => '7.0',
                '6.0' => '6.0',
            ],
        ],

        'laravel-oci8' => [
            'default' => 'master',
            'versions' => [
                'master' => 'Master',
                '9.0' => '9.0',
                '8.0' => '8.0',
                '7.0' => '7.0',
                '6.0' => '6.0',
                '5.3' => '5.3 - 5.8',
            ],
        ],
    ],

    'links' => [
        'laravel-auditable' => [],
        'laravel-acl' => [],
        'laravel-oci8' => [],
        'laravel-datatables' => [
            'datatables' => [
                'title' => 'DataTables.net',
                'icon' => 'nav-datatables',
                'url' => 'https://datatables.net',
            ],
        ],
    ],
];

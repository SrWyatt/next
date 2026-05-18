<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards (Rangos: Admin, Support, User)
    |--------------------------------------------------------------------------
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'support' => [
            'driver' => 'session',
            'provider' => 'supports',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers (Tablas de MariaDB)
    |--------------------------------------------------------------------------
    */

    'providers' => [
        'users' => [
            'driver' => 'database',
            'table' => 'users',
        ],
        'admins' => [
            'driver' => 'database',
            'table' => 'admins',
        ],
        'supports' => [
            'driver' => 'database',
            'table' => 'support',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => 10800,

];

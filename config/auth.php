<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => 'web', // Let's default to customer, can also be 'web'
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [
        // Default Laravel web guard (good practice to keep)
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        // Your custom admin guard
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        // Your custom customer guard
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |-------------------------------------------------------------------------
    */

    'providers' => [
        // Default Laravel user provider
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        // Your custom admins provider
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        // Your custom customers provider
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
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

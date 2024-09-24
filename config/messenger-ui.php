<?php

return [
    /*
    |--------------------------------------------------------------------------
    | The name of your application
    |--------------------------------------------------------------------------
    |
    */
    'site_name' => env('MESSENGER_SITE_NAME', 'Messenger'),

    /*
    |--------------------------------------------------------------------------
    | Websocket information we inject into our javascript. They should match
    | your pusher/laravel-websocket configs.
    |--------------------------------------------------------------------------
    |
    */
    'websocket' => [
        'pusher' => env('MESSENGER_PUSHER'),
        'host' => env('PUSHER_HOST'),
        'auth_endpoint' => env('MESSENGER_SOCKET_AUTH_ENDPOINT', '/api/broadcasting/auth'),
        'key' => env('PUSHER_APP_KEY'),
        'port' => env('PUSHER_PORT'),
        'use_tls' => env('MESSENGER_SOCKET_TLS', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Messenger-UI web routes config
    |--------------------------------------------------------------------------
    |
    | Invite view / redemption routes have individual middleware control so
    | that you may allow both guest or authed users to access.
    |
    | *For the broadcasting channels to register, you must have already
    | setup/defined your laravel apps broadcast driver.
    |
    */
    'routing' => [
        'domain' => null,
        'prefix' => 'messenger',
        'middleware' => [
            'web', 
            'auth:sanctum', 
            'messenger.provider:required',
            // 'localeSessionRedirect', 
            // 'localizationRedirect', 
            // 'localeViewPath'
        ],
        'invite_middleware' => ['web', 'messenger.provider'],
    ],
];

<?php

return [
    'api_key' => 'wg_c3eda997dc9849c82fdadf2063236a994',
    'original_language' => config('app.locale', 'en'),
    'destination_languages' => [
        'bg'
    ],
    'exclude_blocks' => [],
    'exclude_urls' => [],
    'prefix_path' => '',
    'cache' => false,

    'laravel' => [
        'controller_namespace' => 'App\Http\Controllers',
        'routes_web' => 'routes/web.php'
    ]
];

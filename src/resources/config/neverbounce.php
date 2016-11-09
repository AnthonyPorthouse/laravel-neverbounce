<?php

return [

    'secret_key' => env('NEVERBOUNCE_SECRET_KEY'),
    'key' => env('NEVERBOUNCE_USERNAME'),
    'valid_results' => [
        'valid'
    ],
    'router' => env('NEVERBOUNCE_ROUTER', null),
    'version' => env('NEVERBOUNCE_VERSION', null),

];

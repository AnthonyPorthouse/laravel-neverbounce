<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Neverbounce Credentials
    |--------------------------------------------------------------------------
    |
    | These are your Neverbounce credentials, found at:
    | https://app.neverbounce.com/settings/api
    |
    */

    'secret_key' => env('NEVERBOUNCE_SECRET_KEY'),
    'key' => env('NEVERBOUNCE_USERNAME'),

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    |
    | By default, only addresses that return as "valid" will be considered
    | valid when calling NeverBounce::valid() or using the NeverBounce
    | form validator. You may want to tweak these settings (for example, you
    | may want to allow disposable or catchall addresses).
    |
    | See: https://neverbounce.com/help/getting-started/result-codes/
    |
    */

    'valid_results' => [
        'valid'
    ],

    /*
    |--------------------------------------------------------------------------
    | Optional Settings
    |--------------------------------------------------------------------------
    |
    | If you leave these NULL, the default API router and version will be used,
    | which is most likely what you want. Only set these if you have a good
    | reason to.
    |
    */

    'router' => env('NEVERBOUNCE_ROUTER', null),
    'version' => env('NEVERBOUNCE_VERSION', null),

];

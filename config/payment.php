<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Payment gateways
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party payment gateways such
    | as hyperpay.
    */

    'hyperpay' => [
        'url' => env('HYPERPAY_URL'),
        'auth_key' => env('HYPERPAY_AUTH_KEY'),
        'entity_id' => env('HYPERPAY_ENTITY_ID'),
        'production' => env('HYPERPAY_PRODUCTION'),
    ],
];

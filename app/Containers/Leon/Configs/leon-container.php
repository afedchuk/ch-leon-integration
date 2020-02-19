<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Leon Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    /*
     * API url
     */
    'api_url'          => env('LEON_API_URL'),

    /*
     * User credentials
     */
    'user_credentials' => [
        'username'      => env('LEON_USERNAME'),
        'password'      => env('LEON_PASSWORD'),
        'operator_code' => env('LEON_OPERATOR_CODE'),
    ],

    'operator_id' => env('LEON_OPERATOR_ID'),
];

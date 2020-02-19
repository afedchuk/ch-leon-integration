<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messagebus Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    'application_id' => env('MB_APPLICATION_ID'),
    'exchange_name'  => env('MB_EXCHANGE_NAME'),

    /*
     * Connections
     */
    'connections'    => [
        'amqp' => [
            'host'               => env('MB_HOST'),
            'port'               => env('MB_PORT'),
            'user'               => env('MB_USER'),
            'pass'               => env('MB_PASSWORD'),
            'vhost'              => env('MB_VHOST', '/'),
            'ssl_on'             => env('MB_SSL_ON', false),
            'connection_timeout' => 600,
        ],
    ],

    /*
     * Messages
     */
    'messages'       => [
        'bookings' => [
            'follow' => env('MB_MESSAGE_BOOKINGS_FOLLOW', 'bookings.follow'),
            'update' => env('MB_MESSAGE_BOOKINGS_UPDATE', 'bookings.update'),
        ],
    ],
];

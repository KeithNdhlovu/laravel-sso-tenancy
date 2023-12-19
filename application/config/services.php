<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'discord' => [
        'webhook_url' => env('DISCORD_WEBHOOK_URL', 'https://discord.com/api/webhooks'),
    ],

    'laravelpassport' => [
        'default' => [
            'host' => env('LARAVELPASSPORT_HOST'),
            'client_id' => env('LARAVELPASSPORT_CLIENT_ID'),
            'client_secret' => env('LARAVELPASSPORT_CLIENT_SECRET'),
            'redirect' => env('LARAVELPASSPORT_REDIRECT_URI'),
        ],
        't1' => [
            'host' => env('LARAVELPASSPORT_HOST'),
            'client_id' => env('T1_CLIENT_ID'),
            'client_secret' => env('T1_CLIENT_SECRET'),
            'redirect' => env('T1_REDIRECT_URI'),
        ],
        't2' => [
            'host' => env('LARAVELPASSPORT_HOST'),
            'client_id' => env('T2_CLIENT_ID'),
            'client_secret' => env('T2_CLIENT_SECRET'),
            'redirect' => env('T2_REDIRECT_URI'),
        ],
    ],
];

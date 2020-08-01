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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    'stripe' => [
        'secret' => 'sk_test_nOPOewW4QLTHUSt07NAexKdA00cMKGDpqC',
    ],

    'facebook' => [
    'client_id' => env('FACEBOOK_APP_ID','597669324496756'),
    'client_secret' => env('FACEBOOK_APP_SECRET','cf39759cd1f37e53573aa0f760b626bc'),
    'redirect' => env('FACEBOOK_REDIRECT','http://localhost:8000/callback'),
    ],

    'google' => [
    'client_id'     => env('GOOGLE_CLIENT_ID','1049367246276-u4unr46vt38pb2llmlotikmois3ikkbg.apps.googleusercontent.com'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET','O1mYaQzs4dcynm0T6thCSQk1'),
    'redirect'      => env('GOOGLE_REDIRECT','http://127.0.0.1:8000/google/callback')
    ],
];

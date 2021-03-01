<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'google' => [
        'client_id'     => '584753990248-md31jnubs9bdmmpdgm3o5076ggui7676.apps.googleusercontent.com',
        'client_secret' => 'aqdUmYQ_I-wwuyPPQ-9cym9R',
        'redirect'      => 'http://localhost:8080/exam/public/auth/google/callback'
    ],

    // 'clientId'     => '584753990248-md31jnubs9bdmmpdgm3o5076ggui7676.apps.googleusercontent.com',
    // 'clientSecret' => 'aqdUmYQ_I-wwuyPPQ-9cym9R',
    // 'redirectUri'  => 'http://localhost:8080/wordpress/mainlogin/',

];

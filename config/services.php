<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],
    
    'recaptcha' => [
        'active' => env('CAPTCHA_ACTIVE', true),
        'secret' => env('GOOGLE_RECAPTCHA_SECRET', '6LeHN4sUAAAAAHH1IZUW2gMnfuu6EHV0pQg35Ahh'),
        'site' => env('GOOGLE_RECAPTCHA_KEY', '6LeHN4sUAAAAAIx9y6Ku4uGbFWZa7ilmJPlhdqMa'),
        'siteverify' => env('SITE_VERIFY','https://www.google.com/recaptcha/api/siteverify')
    ],        

];

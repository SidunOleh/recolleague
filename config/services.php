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

    'google' =>  [
        'client_id' => '168054422893-9fjedjt2q1crg5b4m874jj61vnvhfmsn.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://recolleague.com/oauth/google/callback',  
    ],
    'facebook' =>  [
        'client_id' => '655486156506751',
        'client_secret' => '3120c005211569258e421d2373db84f8',
        'redirect' => 'https://recolleague.com/oauth/facebook/callback',  
    ],

];

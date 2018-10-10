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
    ],


    'facebook' => [
    'client_id' => '307319486722440',         // Your Facebook Client ID
    'client_secret' =>'bb11af4b47b75d547843c17ef3186bcb', // Your Facebook Client Secret
    'redirect' => 'http://localhost:8000/login/facebook/callback',
],

    'google' => [
    'client_id' => '533007552611-69s07773kj0u88thrf1injvfsop045bj.apps.googleusercontent.com',
    // Your Google Client ID
    'client_secret' =>'MnmoDMKwgDVGRpXqwcaelNIm', // Your Google Client Secret
    'redirect' => 'http://localhost:8000/login/google/callback',
],

];

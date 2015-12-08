<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mandrill' => [
        'secret' => $_ENV['MAIL_SECRET'],
    ],
    'qq' => [
        'client_id' => env('QQ_KEY'),
        'client_secret' => env('QQ_SECRET'),
        'redirect' => env('QQ_REDIRECT_URI'),  
    ],
    'weixin' => [
        'client_id' => env('WEIXIN_KEY'),
        'client_secret' => env('WEIXIN_SECRET'),
        'redirect' => env('WEIXIN_REDIRECT_URI'),  
    ],
    'weibo' => [
        'client_id' => env('WEIBO_KEY'),
        'client_secret' => env('WEIBO_SECRET'),
        'redirect' => env('WEIBO_REDIRECT_URI'),  
    ],
];

<?php

declare(strict_types=1);

/*
 * You can place your custom package configuration in here.
 */
return [
    //HUF
    'HUF_MERCHANT' => env('SIMPLEPAY_HUF_MERCHANT'),            //merchant account ID (HUF)
    'HUF_SECRET_KEY' => env('SIMPLEPAY_HUF_SECRET_KEY'),          //secret key for account ID (HUF)
    //EUR
    'EUR_MERCHANT' => env('SIMPLEPAY_EUR_MERCHANT'),            //merchant account ID (EUR)
    'EUR_SECRET_KEY' => env('SIMPLEPAY_EUR_SECRET_KEY'),          //secret key for account ID (EUR)
    //USD
    'USD_MERCHANT' => env('SIMPLEPAY_USD_MERCHANT'),            //merchant account ID (USD)
    'USD_SECRET_KEY' => env('SIMPLEPAY_USD_SECRET_KEY'),          //secret key for account ID (USD)
    'SANDBOX' => env('SIMPLEPAY_SANDBOX', true),

    // Common return URL
    'URL' => env('SIMPLEPAY_URL_RETURN', 'http://yourappurl.tld/back'), // with named routes 'simplepay.success'

    'NAMED_ROUTES' => env('SIMPLEPAY_NAMED_ROUTES', false),

    // Optional unique return urls (besure to set 'SIMPLEPAY_NAMED_ROUTES' to true in your .env)
    // 'SUCCESS_PAGE_ROUTE_NAME' => env('SIMPLEPAY_SUCCESS_PAGE_ROUTE_NAME', 'simplepay.success'),
    // 'FAIL_PAGE_ROUTE_NAME' => env('SIMPLEPAY_FAIL_PAGE_ROUTE_NAME', 'simplepay.fail'),
    // 'CANCEL_PAGE_ROUTE_NAME' => env('SIMPLEPAY_CANCEL_PAGE_ROUTE_NAME', 'simplepay.cancel'),
    // 'TIMEOUT_PAGE_ROUTE_NAME' => env('SIMPLEPAY_TIMEOUT_PAGE_ROUTE_NAME', 'simplepay.timeout'),

    'GET_DATA' => (isset($_GET['r']) && isset($_GET['s'])) ? ['r' => $_GET['r'], 's' => $_GET['s']] : [],
    'POST_DATA' => $_POST,
    'SERVER_DATA' => $_SERVER,
    'LOGGER' => true,                      //basic transaction log
    'LOG_PATH' => 'log',                     //path of log file
    'AUTOCHALLENGE' => true,                      //in case of unsuccessful payment with registered card run automatic challange
];

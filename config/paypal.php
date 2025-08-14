<?php

return [
    'settings' => [
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 60,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('logs\paypal.log'),
        'log.LogLevel' => 'ERROR',
    ]
];
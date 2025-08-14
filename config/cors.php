<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],  // O puedes especificar métodos como 'GET', 'POST', etc.

    'allowed_origins' => ['*'],  // O puedes especificar tus orígenes como ['https://example.com']

    'allowed_headers' => ['*'],  // O puedes especificar cabeceras como ['Content-Type', 'X-Requested-With']

    'exposed_headers' => false,

    'max_age' => 0,

    'supports_credentials' => false,

];

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethodallowedOriginss can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => [ '*'],
    'allowedOriginsPatterns' => ['*'],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['OPTIONS', 'GET', 'POST', 'PUT', 'DELETE'],
    'exposedHeaders' => [],
    'maxAge' => 60 * 60 * 24,
    'hosts' => []

];

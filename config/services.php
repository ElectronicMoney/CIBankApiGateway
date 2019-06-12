<?php
/**
 * Fetching the list of from the micro service
 * @param void
 * @return string $base_uri
 */
return [
    'api_gateway' =>  [
        'base_uri'  => env('API_GATEWAY_BASE_URL'),
        'api_gateway_token' => env('API_GATEWAY_TOKEN'),
    ]
];


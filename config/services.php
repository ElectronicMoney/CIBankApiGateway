<?php
/**
 * Fetching the list of from the micro service
 * @param void
 * @return string $base_uri
 */
return [
    'api_gateway_access_token' => env('API_GATEWAY_ACCESS_TOKEN'),

    'customer_service' =>  [
        'base_uri'  => env('CUSTOMER_SERVICE_BASE_URL'),
    ]

];


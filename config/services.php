<?php
/**
 * Fetching the list of from the micro service
 * @param void
 * @return string $base_uri
 */
return [
    'example' =>  [
        'id'        => env('EXAMPLE_SERVICE_ID'),
        'name'      => env('EXAMPLE_SERVICE_NAME'),
        'base_uri'  => env('EXAMPLE_SERVICE_BASE_URL'),
        'api_token' => env('EXAMPLE_SERVICE_API_TOKEN'),
    ]
];

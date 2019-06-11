<?php

return [
    'grant_types' => [
        'password'           => env('PASSWORD_GRANT', 'password'),
        'refresh_token'      => env('REFRESH_TOKEN_GRANT', 'refresh_token'),
        'client_credentials' => env('CLIENT_CREDENTIALS_GRANT', 'client_credentials'),
        'authorization_code' => env('AUTHORIZATION_CODE_GRANT', 'authorization_code'),
        'implicit'           => env('IMPLICIT_GRANT', 'implicit'),
    ],

    'credentials' => [
        'client_id'         => env('CLIENT_ID'),
        'client_secret'     => env('CLIENT_SECRET'),
        'redirect_uri'      => env('REDIRECT_URI'),
        'response_type'     => env('RESPONSE_TYPE'),
        'scope'             => env('SCOPE'),
    ],

];

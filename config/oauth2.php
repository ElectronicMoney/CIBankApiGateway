<?php

return [

    /**
     * Password Grant Tokens The OAuth2 password grant allows your
     * other first-party clients, such as a mobile application,
     * to obtain an access token using an e-mail address / username and password.
     * This allows you to issue access tokens securely to your first-party
     * clients without requiring your users to go through the entire OAuth2
     * authorization code redirect flow.
     *
     * Creating A Password Grant Client
     * Before your application can issue tokens via the password grant,
     * you will need to create a password grant client.
     * You may do this using the passport:client command with the  --password option.
     * If you have already run the passport:install command,
     *
     * Requesting Tokens:
     * Once you have created a password grant client, you may request an
     * access token by issuing a  POST request to the /oauth/token route
     * with the user's email address and password. Remember, this route
     * is already registered by the Passport::routes method so there
     * is no need to define it manually. If the request is successful,
     * you will receive an access_token and  refresh_token in the JSON
     * response from the server:
     */

    'password_grant' => [
        'grant_type'    => env('PD_GRANT_TYPE', 'password'),
        'client_id'     => env('PD_GRANT_CLIENT_ID', 2),
        'client_secret' => env('PD_GRANT_CLIENT_SECRET'),
        'scope'         => env('PD_GRANT_SCOPE', '*'),
    ],

    /**
     * Refreshing Tokens
     * If your application issues short-lived access tokens,
     * users will need to refresh their access tokens via the
     * refresh token that was provided to them when the access
     * token was issued. In this example, we'll use the Guzzle
     * HTTP library to refresh the token:
     *
     * Refreshing Tokens:
     * If your application issues short-lived access tokens, users
     * will need to refresh their access tokens via the refresh token
     * that was provided to them when the access token was issued.
     * In this example, we'll use the Guzzle HTTP library to refresh the token:
     */
    'refresh_token_grant' => [
        'grant_type'    => env('RT_GRANT_TYPE', 'refresh_token'),
        'client_id'     => env('RT_GRANT_CLIENT_ID', 1),
        'client_secret' => env('RT_GRANT_CLIENT_SECRET'),
        'scope'         => env('RT_GRANT_SCOPE', '*'),
    ],

    /**
     * When using the password grant or client credentials grant,
     * you may wish to authorize the token for all of the scopes
     * supported by your application. You can do this by requesting
     * the * scope. If you request the * scope, the can method on the
     * token instance will always return true. This scope may only
     * be assigned to a token that is issued using the password or
     *
     * client_credentials grant:
     * Retrieving Tokens To retrieve a token using this grant type,
     * make a request to the oauth/token endpoint:
     */
    'client_credentials_grant' => [
        'grant_type'    => env('CC_GRANT_TYPE', 'client_credentials'),
        'client_id'     => env('CC_GRANT_CLIENT_ID', 1),
        'client_secret' => env('CC_GRANT_CLIENT_SECRET'),
        'scope'         => env('CC_GRANT_SCOPE', '*'),
    ],

    /**
     * Converting Authorization Codes To Access Tokens If the user approves t
     * he authorization request, they will be redirected back to the consuming application.
     * The consumer should then issue a POST request to your application to
     * request an access token. The request should include the authorization code
     * that was issued by your application when the user approved the authorization
     * request. In this example, we'll use the
     * Guzzle HTTP library to make the POST request:
     */
    'authorization_code_grant' => [
        'grant_type'    => env('AC_GRANT_TYPE', 'authorization_code'),
        'client_id'     => env('AC_GRANT_CLIENT_ID', 1),
        'client_secret' => env('AC_GRANT_CLIENT_SECRET'),
        'redirect_uri'  => env('AC_GRANT_REDIRECT_URI'),
    ],

    /**
     * Implicit Grant Tokens:
     * The implicit grant is similar to the authorization code grant;
     * however, the token is returned to the client without exchanging
     * an authorization code. This grant is most commonly used for
     * JavaScript or mobile applications where the client credentials
     * can't be securely stored. To enable the grant,
     * call the enableImplicitGrant method in your AuthServiceProvider:
     */
    'implicit_grant' => [
        'grant_type'    => env('IT_GRANT_TYPE', 'implicit'),
        'client_id'     => env('IT_GRANT_CLIENT_ID', 1),
        'response_type' => env('IT_GRANT_CLIENT_SECRET'),
        'redirect_uri'  => env('IT_GRANT_REDIRECT_URI'),
        'scope'         => env('IT_GRANT_SCOPE', ''),
    ],

];

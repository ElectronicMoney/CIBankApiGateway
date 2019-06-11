<?php

namespace App\Http\Middleware;

use Closure;

class AuthApiProxyMiddleware
{
    /**
     * The OAuth2
     *
     * @var
     */
    private $OAuth2;
    private $grantType;
    private $passwordGrant;
    private $clientCredentialsGrant;
    private $clientId;
    private $clientSecret;
    private $apiToken;
    private $scope;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct() {
        $this->passwordGrant          = config('oauth2.grant_types.password');
        $this->clientCredentialsGrant = config('oauth2.grant_types.client_credentials');
        $this->clientId        = config('oauth2.credentials.client_id');
        $this->clientSecret    = config('oauth2.credentials.client_secret');
        $this->scope           = config('oauth2.credentials.scope');
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Pre-Middleware Action
        /**
         *Check if the request method is POST
         *and request uri is oauth/token
         * */
        if ($request->path() === 'oauth/token') {
            //Check if the request has api_token
            if ($request->has('service_id') && $request->has('api_token') ) {
                //Get the api_token using service_id
                $this->apiToken  = config("services.{$request->input('service_id')}.api_token");
                //Check if the both api_token matches
                if ($request->input('api_token') === $this->apiToken ) {
                    $this->grantType = $this->clientCredentialsGrant;
                } else {
                    $this->grantType = $this->passwordGrant;
                }
            }

            //If it it not password grant type; then client_secret is required
            $this->OAuth2 = [
                'grant_type'    => $this->grantType,
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope'         => $this->scope,
            ];

            $request->request->add($this->OAuth2);
        }

        $response = $next($request);
        // Post-Middleware Action
        return $response;
    }
}

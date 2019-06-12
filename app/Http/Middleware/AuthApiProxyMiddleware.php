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
    private $clientId;
    private $clientSecret;
    private $scope;
    private $passwordGrant;
    private $clientCredentialsGrant;
    private $apiGatewayAccessToken;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct() {
        $this->clientId     = config('oauth2.credentials.client_id');
        $this->clientSecret = config('oauth2.credentials.client_secret');
        $this->scope        = config('oauth2.credentials.scope');
        $this->passwordGrant = config('oauth2.grant_types.password');
        $this->clientCredentialsGrant = config('oauth2.grant_types.client_credentials');
        $this->apiGatewayAccessToken = config('services.api_gateway_access_token');
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
         *Check if request uri is oauth/token
         * */
        if ($request->path() === 'oauth/token') {
            // 1. Check if the request has apigatewayAccessToken
            // 2. If it has it; set grantType to client_credentails
            if ($request->has('api_gateway_access_token') && $request->input('api_gateway_access_token') === $this->apiGatewayAccessToken) {
                $this->grantType = $this->clientCredentialsGrant;
            } else {
                $this->grantType = $this->passwordGrant;
            }

            $this->OAuth2 = [
                'grant_type'    => $this->grantType,
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope'         => $this->scope,
            ];
            //Inject OAuth2 array into the incoming request
            $request->request->add($this->OAuth2);
        }

        $response = $next($request);
        // Post-Middleware Action
        return $response;
    }
}

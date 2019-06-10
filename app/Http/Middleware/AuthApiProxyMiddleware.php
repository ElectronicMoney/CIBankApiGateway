<?php

namespace App\Http\Middleware;

use Closure;

class AuthApiProxyMiddleware
{
    /**
     * The OAuth2Credentials
     *
     * @var
     */
    public $OAuth2Credentials;
    public $grantType;
    public $clientId;
    public $clientSecret;
    public $scope;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct()
    {
        $this->grantType    = config('oauth2.password_grant.grant_type');
        $this->clientId     = config('oauth2.password_grant.client_id');
        $this->clientSecret = config('oauth2.password_grant.client_secret');
        $this->scope        = config('oauth2.password_grant.scope');
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
            $this->OAuth2Credentials = [
                'grant_type'    => $this->grantType,
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope'         => $this->scope,
            ];

            $request->request->add($this->OAuth2Credentials);
        }

        $response = $next($request);
        // Post-Middleware Action
        return $response;
    }
}

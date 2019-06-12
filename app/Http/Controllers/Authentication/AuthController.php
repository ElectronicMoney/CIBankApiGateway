<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use App\Transformer\ApiJsonTransformer;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegisteredEvent;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    private $apiTransformer;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiJsonTransformer $apiTransformer) {
        $this->apiTransformer = $apiTransformer;
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login() {
        if ( Auth::check()) {
            return $this->apiTransformer->successResponse(Auth::user());
        }
        return $this->apiTransformer->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        if ( Auth::check()) {
            $accessToken = Auth::user()->token();
            DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update([
                    'revoked' => true
                ]);
            $accessToken->revoke();
            return $this->apiTransformer->successResponse(null, ApiJsonTransformer::HTTP_NO_CONTENT);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        //The rules
        $rules = [
           'name'     => ['required', 'max:255'],
           'username' => ['required', 'unique:users', 'max:255'],
           'email'    => ['required', 'unique:users', 'max:255'],
           'password' => ['required', 'string', 'min:8', 'confirmed'],
       ];
       //validate the request
      $this->validate($request, $rules);
       //instantiate the User
       $user = new User();
       $user->name     = $request->input('name');
       $user->username = $request->input('username');
       $user->email    = $request->input('email');
       $user->password = (new BcryptHasher)->make($request->input('password'));
       //Save the user
       $user->save();
       //Fire UserRegisteredEvent
       event(new UserRegisteredEvent($user));
       //Return the new user
       return $this->apiTransformer->successResponse($user, ApiJsonTransformer::HTTP_OK);
   }


}

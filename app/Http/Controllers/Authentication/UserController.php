<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use App\Transformer\ApiJsonTransformer;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public $apiTransformer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiJsonTransformer $apiTransformer) {
        $this->apiTransformer = $apiTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if (Auth::user()->isAdministrator()) {
            $users = User::all();
            return $this->apiTransformer->successResponse($users, ApiJsonTransformer::HTTP_OK);
        }

        return $this->apiTransformer->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($userId) {
        /**
         *Check if the Authenticated user is resorce owner
         *Or is an Administrator
         * */
        if ( Auth::user()->isAdministrator() || Auth::id() === $userId ) {
            //get user with the given userId
            $user = User::findOrFail($userId);
            //Return the new user
            return $this->apiTransformer->successResponse($user, ApiJsonTransformer::HTTP_OK);
        }

        return $this->apiTransformer->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId) {
        /**
         *Check if the Authenticated user is resorce owner
         *Or is an Administrator
         * */
        if ( Auth::user()->isAdministrator() || Auth::id() === $userId ) {
            //The rules
            $rules = [
                'name'     => ['max:255'],
                'username' => ['unique:users', 'max:255'],
                'email'    => ['unique:users', 'max:255'],
                'password' => ['string', 'min:8', 'confirmed'],
            ];
            //validate the request
        $this->validate($request, $rules);
            //get user with the given userId
            $user = User::findOrFail($userId);

            //Check if the request has name
            if ($request->has('name')) {
                $user->name    = $request->input('name');
            }
            //Check if the request has username
            if ($request->has('username')) {
                $user->username    = $request->input('username');
            }
            //Check if the request has email
            if ($request->has('email')) {
                $user->email  = $request->input('email');
            }
            //Check if the request has password
            if ($request->has('password')) {
                $user->password = (new BcryptHasher)->make($request->input('password'));
            }
            //Check if anything changed in user
            if ($user->isClean()) {
                return $this->apiTransformer->errorResponse('You must specify a new value to update', ApiJsonTransformer::HTTP_UNPROCESSABLE_ENTITY);
            }
            //Save the user
            $user->save();
            //Return the new user
            return $this->apiTransformer->successResponse($user, ApiJsonTransformer::HTTP_OK);
        }

        return $this->apiTransformer->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId) {
          /**
         *Check if the Authenticated user is resorce owner
         *Or is an Administrator
         * */

        if ( Auth::user()->isAdministrator() || Auth::id() === $userId ) {
            //get user with the given userId
            $user = User::findOrFail($userId);
            //delete user
            $user->delete();
            //Return the new user
            return $this->apiTransformer->successResponse($user, ApiJsonTransformer::HTTP_OK);
        }

        return $this->apiTransformer->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);
    }

}

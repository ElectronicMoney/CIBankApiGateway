<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
         //The rules
         $rules = [
            'name'     => 'required|max:255',
            'username' => 'required|unique|max:255',
            'email'    => 'required|unique|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'confirm|max:255',
        ];
        //validate the request
       $this->validate($request, $rules);
        //instantiate the User
        $user = new User();
        $user->name     = $request->input('name');
        $user->username = $request->input('username');
        $user->email    = $request->input('email');
        $user->password = (new BcryptHasher($request->input('password')));
        //Save the user
        $user->save();
        //Return the new user
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($userId) {
        //get user with the given userId
        $user = User::findOrFail($userId);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId) {
        //The rules
        $rules = [
            'name'     => 'max:255',
            'username' => 'unique|max:255',
            'email'    => 'unique|max:255',
            'password' => 'max:255',
            'password_confirmation' => 'confirm|max:255',
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
            $user->password  = $request->input('password');
        }
        //Check if anything changed in user
        if ($user->isClean()) {
            return 'You must specify a new value to update';
        }
        //Save the user
        $user->save();
        //Return the new user
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId) {
        //get user with the given userId
        $user = User::findOrFail($userId);
        $user->delete();
        //Return the new user
        return $user;

    }

}

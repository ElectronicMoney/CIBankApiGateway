<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * Auhentication routes
 */
$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->post('/login', 'Auth\AuthController@login');
    $router->post('/logout', 'Auth\AuthController@logout');
    $router->post('/register', 'Auth\AuthController@register');
});

/**
 * Users and Roles routes
 */
$router->group(['prefix' => 'v1', 'middleware' => 'auth'], function () use ($router) {
    //UserController routes
    $router->post('/users', 'User\UserController@store');
    $router->get('/users', 'User\UserController@index');
    $router->get('/users/{user}', 'User\UserController@show');
    $router->put('/users/{user}', 'User\UserController@update');
    $router->patch('/users/{user}', 'User\UserController@update');
    $router->delete('/users/{user}', 'User\UserController@destroy');

    //RoleController routes
    $router->post('/roles', 'Auth\RoleController@store');
    $router->get('/roles', 'Auth\RoleController@index');
    $router->get('/roles/{role}', 'Auth\RoleController@show');
    $router->put('/roles/{role}', 'Auth\RoleController@update');
    $router->patch('/roles/{role}', 'Auth\RoleController@update');
    $router->delete('/roles/{role}', 'Auth\RoleController@destroy');
});


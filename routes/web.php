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
    $router->post('/register', 'Auth\AuthController@register');
});

/**
 * Users and Roles routes
 */
$router->group(['prefix' => 'v1', 'middleware' => 'auth'], function () use ($router) {
    $router->post('/users', 'UserController@store');
    $router->get('/users', 'UserController@index');
    $router->get('/users/{user}', 'UserController@show');
    $router->put('/users/{user}', 'UserController@update');
    $router->patch('/users/{user}', 'UserController@update');
    $router->delete('/users/{user}', 'UserController@destroy');

    $router->post('/roles', 'RoleController@store');
    $router->get('/roles', 'RoleController@index');
    $router->get('/roles/{role}', 'RoleController@show');
    $router->put('/roles/{role}', 'RoleController@update');
    $router->patch('/roles/{role}', 'RoleController@update');
    $router->delete('/roles/{role}', 'RoleController@destroy');
});

/**
 * ExampleService routes
 */
$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('/examples', 'Services\ExampleServiceController@index');
    $router->post('/examples', 'Services\ExampleServiceController@store');
    $router->get('/examples/{example}', 'Services\ExampleServiceController@show');
    $router->put('/examples/{example}', 'Services\ExampleServiceController@update');
    $router->patch('/examples/{example}', 'Services\ExampleServiceController@update');
    $router->delete('/examples/{example}', 'Services\ExampleServiceController@destroy');
});

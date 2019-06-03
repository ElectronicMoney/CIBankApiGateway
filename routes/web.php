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
    $router->get('/users/{user}', 'Auth\UserController@show');
    $router->put('/users/{user}', 'Auth\UserController@update');
    $router->patch('/users/{user}', 'Auth\UserController@update');
    $router->delete('/users/{user}', 'Auth\UserController@destroy');

    $router->post('/examples', 'Services\ExampleServiceController@store');
    $router->get('/examples/{example}', 'Services\ExampleServiceController@show');
    $router->put('/examples/{example}', 'Services\ExampleServiceController@update');
    $router->patch('/examples/{example}', 'Services\ExampleServiceController@update');
    $router->delete('/examples/{example}', 'Services\ExampleServiceController@destroy');
});


/**
 * Users and Roles routes
 */
$router->group(['prefix' => 'v1/management', 'middleware' => 'auth'], function () use ($router) {
    $router->post('/users', 'Management\Auth\ManageUserController@store');
    $router->get('/users', 'Management\Auth\ManageUserController@index');
    $router->get('/users/{user}', 'Management\Auth\ManageUserController@show');
    $router->put('/users/{user}', 'Management\Auth\ManageUserController@update');
    $router->patch('/users/{user}', 'Management\Auth\ManageUserController@update');
    $router->delete('/users/{user}', 'Management\Auth\ManageUserController@destroy');

    $router->post('/roles', 'Management\Auth\ManageRoleController@store');
    $router->get('/roles', 'Management\Auth\ManageRoleController@index');
    $router->get('/roles/{role}', 'Management\Auth\ManageRoleController@show');
    $router->put('/roles/{role}', 'Management\Auth\ManageRoleController@update');
    $router->patch('/roles/{role}', 'Management\Auth\ManageRoleController@update');
    $router->delete('/roles/{role}', 'Management\Auth\ManageRoleController@destroy');

    $router->get('/examples', 'Management\Services\ManageExampleServiceController@index');
    $router->post('/examples', 'Management\Services\ManageExampleServiceController@store');
    $router->get('/examples/{example}', 'Management\Services\ManageExampleServiceController@show');
    $router->put('/examples/{example}', 'Management\Services\ManageExampleServiceController@update');
    $router->patch('/examples/{example}', 'Management\Services\ManageExampleServiceController@update');
    $router->delete('/examples/{example}', 'Management\Services\ExampleServiceController@destroy');
});


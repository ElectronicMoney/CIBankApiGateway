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

$router->group(['prefix' => 'v1', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
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

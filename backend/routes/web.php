<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
// $router->group(['middleware' => 'protectedRoute','prefix' => '/api/auth'], function() use ($router) {
//    $router->post('login', 'AuthController@login');
//    $router->post('logout', 'AuthController@logout');
//    $router->post('refresh', 'AuthController@refresh');
//    $router->post('me', 'AuthController@me');
// }); 

$router->get('api/users', ['middleware' => 'protectedRoute', 'uses' => 'UsersController@getall']);  
$router->group(['middleware' => 'protectedRoute','prefix' => '/api/user'], function() use ($router){
    $router->get('/{id}', 'UsersController@get');
    $router->post('/', 'UsersController@create');
    $router->put('/{id}', 'UsersController@update');
    $router->delete('/{id}', 'UsersController@delete');

});  

$router->get('/api/clients', ['middleware' => 'protectedRoute', 'uses' => 'ClientsController@getall']);    
$router->group(['middleware' => 'protectedRoute','prefix' => '/api/client'], function() use ($router){
    $router->get('/{id}', 'ClientsController@get');
    $router->post('/', 'ClientsController@create');
    $router->put('/{id}', 'ClientsController@update');
    $router->delete('/{id}', 'ClientsController@delete');

});  

$router->get('/api/evaluations', ['middleware' => 'protectedRoute', 'uses' => 'EvaluationsController@getall']);
$router->group(['middleware' => 'protectedRoute','prefix' => '/api/evaluation'], function() use ($router){
    $router->get('/{id}', 'EvaluationsController@get');
    $router->post('/', 'EvaluationsController@create');
    $router->put('/{id}', 'EvaluationsController@update');
    $router->delete('/{id}', 'EvaluationsController@delete');

});  

$router->get('/api/contributors', ['middleware' => 'protectedRoute', 'uses' => 'ContributorsController@getall']); 
$router->group(['middleware' => 'protectedRoute','prefix' => '/api/contributor'], function() use ($router){
    $router->get('/{id}', 'ContributorsController@get');
    $router->post('/', 'ContributorsController@create');
    $router->put('/{id}', 'ContributorsController@update');
    $router->delete('/{id}', 'ContributorsController@delete');
});  

$router->get('/api/stores', ['middleware' => 'protectedRoute', 'uses' => 'StoresController@getall']); 
$router->group(['middleware' => 'protectedRoute','prefix' => '/api/store'], function() use ($router){
    $router->get('/{id}', 'StoresController@get');
    $router->post('/', 'StoresController@create');
    $router->put('/{id}', 'StoresController@update');
    $router->delete('/{id}', 'StoresController@delete');
});  
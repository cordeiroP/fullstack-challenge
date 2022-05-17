<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PerfilController;

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
$router->group(['prefix' => 'admin'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([

    'middleware' => 'api',
    'prefix' => 'refera'

], function ($router) {

    $router->post('/', 'AuthController@registarUser');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('me', 'AuthController@me');

});

$router->post('registerCategory',[
    'as' => 'registerCategory', 'uses' => 'CategoryController@category'
]);

$router->group([
    "prefix" => "refera"
], function () use ($router) {
    $router->get('/admin', function () use ($router) {
        return $router->app->version();
    });
    $router->post('registerCategory',[
        'as' => 'category', 'uses' => 'CategoryController@category'
    ]);
    $router->get('listCategory', 'CategoryController@listCategory');
    $router->delete('destroyCategory/{id}', 'CategoryController@destroyCategory');
    $router->put('updateCategory/{id}', 'CategoryController@updateCategory');
});


$router->group([
    "prefix" => "refera"
], function () use ($router) {
    $router->get('/','OrderController@home');
    $router->post('registerOrder', 'OrderController@order');
    $router->get('listOrder', 'OrderController@listOrder');
    $router->delete('destroyOrder/{id}', 'OrderController@destroyOrder');
    $router->put('updateOrder/{id}', 'OrderController@updateOrder');
});



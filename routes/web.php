<?php

use App\Http\Controllers\NewsController;
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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function($app) {
    $app->get('/news', 'NewsController@index');
    $app->get('/news/{id}', 'NewsController@show');
    $app->post('news', 'NewsController@strore');
    $app->put('news/{id}', 'NewsController@update');
    $app->delete('news/{id}', 'NewsController@destroy');
});

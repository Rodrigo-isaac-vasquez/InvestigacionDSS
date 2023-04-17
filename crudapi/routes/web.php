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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/cliente','LibroController@index');

$router->get('/cliente/{id}','LibroController@ver');

$router->post('/cliente','LibroController@guardar');

$router->delete('/cliente/{id}','LibroController@eliminar');

$router->post('/cliente/{id}', 'LibroController@actualizar');

$router->patch('/cliente/{id}','LibroController@actualizar');
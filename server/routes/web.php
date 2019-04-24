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

$router->get('/', function () use ($router) {
   return 'Web Wervice Realizado con LSCodeGenerator';
});

$router->group(['middleware' => []], function () use ($router) {
   //CRUD CameraImage
   $router->post('/cameraimage', ['uses' => 'CameraImageController@post']);
   $router->get('/cameraimage', ['uses' => 'CameraImageController@get']);
   $router->get('/cameraimage/paginate', ['uses' => 'CameraImageController@paginate']);
   $router->get('/cameraimage/backup', ['uses' => 'CameraImageController@backup']);
   $router->put('/cameraimage', ['uses' => 'CameraImageController@put']);
   $router->delete('/cameraimage', ['uses' => 'CameraImageController@delete']);
   $router->post('/cameraimage/masive_load', ['uses' => 'CameraImageController@masiveLoad']);
});

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
    return $router->app->version();
});



$router->group(['prefix' => 'checklists/'], function () use ($router) {
    $router->get('templates', 'TemplateController@index');
    $router->post('templates', 'TemplateController@store');
    $router->get('template/{template_id}', 'TemplateController@show');
    $router->patch('template/{template_id}', 'TemplateController@update');
    $router->delete('template/{template_id}', 'TemplateController@destroy');
});
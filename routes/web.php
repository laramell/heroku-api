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
    return 'Hello, world!';
});

$router->group(['prefix' => 'students'], function () use ($router){
    $router->get('/', 'StudentsController@all');
    $router->get('/id', 'StudentsController@selectById');
    $router->get('/email', 'StudentsController@selectByEmail');
    $router->get('/since', 'StudentsController@selectBySince');
});

$router->group(['prefix' => 'cards'], function () use ($router){
    $router->get('/', 'CardsController@all');
    $router->get('/student', 'CardsController@selectByStudent');
    $router->get('/review/student/today', 'CardsController@selectByReviewAndStudentToday');
    $router->get('/review/student/late', 'CardsController@selectByReviewAndStudentLate');
});

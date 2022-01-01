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
    /*
     * Get Router
     * */

    // Show all students
    $router->get('/', 'StudentsController@all');

    // Show a student based on id
    $router->get('/id', 'StudentsController@selectById');

    // Show a student based on email
    $router->get('/email', 'StudentsController@selectByEmail');

    // Show a student based on since date
    $router->get('/since', 'StudentsController@selectBySince');

    /*
     * Post Router
     * */

    // Register a new student
    $router->post('/', "StudentsController@register");

    // Update a student based on id
    $router->put('/', "StudentsController@update");

    // Delete a student based on id
    $router->delete('/', "StudentsController@delete");
});


$router->group(['prefix' => 'cards'], function () use ($router){

    /*
     * Get Router
     * */

    // Show all cards
    $router->get('/', 'CardsController@all');
    $router->get('/teste', 'CardsController@teste');

    // Show a card based on Student id
    $router->get('/student', 'CardsController@selectByStudent');

    // Show a card that needs to be revised today based on Student id and today's date
    $router->get('/review/student/today', 'CardsController@selectByReviewAndStudentToday');

    // Show a card that is overdue for revision
    $router->get('/review/student/late', 'CardsController@selectByReviewAndStudentLate');

    /*
     * Post Router
     * */

    // Register a new card
    $router->post('/', 'CardsController@register');

    // Delete a card based on id
    $router->post('/', 'CardsController@register');
});
$router->group(['prefix' => 'reviews'], function () use ($router) {

    /*
     * Get Router
     * */
    $router->get('/', 'CardsController@all');
});

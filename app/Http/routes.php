<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
    return $app->welcome();
});


$app->get('/1.0/users/login/{name}/{password}','App\Http\Controllers\UserController@login');

$app->get('/1.0/enterprises/names/{text}','App\Http\Controllers\EnterpriseController@filter');

$app->get('/1.0/attendances/workers/{local_id}','App\Http\Controllers\AttendanceController@workers');

$app->get('/1.0/attendances/register/{dni}/{latitude}/{longitude}/{hour}/{type}','App\Http\Controllers\AttendanceController@register');

$app->post('/1.0/workplaces/register_location/{id}/{latitude}/{longitude}','App\Http\Controllers\WorkplaceController@register_location');


//$app->put('1.0/article/{id}','App\Http\Controllers\ArticleController@updateArticle');

//$app->delete('1.0/article/{id}','App\Http\Controllers\ArticleController@deleteArticle');
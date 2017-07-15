<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::get('todolist', function()
{
    return View::make('todolist');
});

Route::post('/tasks', 'TodolistController@create');

Route::get('/tasks', 'TodolistController@getAll');

//Route::patch('/tasks/{id}', 'TodolistController@update');
Route::post('/tasks/{id}', 'TodolistController@updateStatus');

Route::post('/delete', 'TodolistController@delete');
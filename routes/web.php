<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ProjectsController@index');
Route::resource('projects', 'ProjectsController');
Route::delete('tasks/{task}/steps/clear', 'StepController@clear');
Route::post('tasks/{task}/steps/complete', 'StepController@completeAll');
Route::patch('tasks/{task}/steps/{step}/toggle', 'StepController@toggle');
Route::resource('tasks', 'TasksController');
Route::resource('tasks.steps', 'stepController');
Route::post('tasks/{id}/check', 'TasksController@check')->name('tasks.check');
Route::delete('tasks/{id}/destroy', 'TasksController@destroy')->name('tasks.destroy');
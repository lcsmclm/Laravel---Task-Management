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
Route::get('/','UserController@postForm')->middleware('auth'); //New - Form Entry
Route::post('/new/add','UserController@newPost')->middleware('auth'); //New submit - Push to DB
Route::get('/', 'UserController@getAll')->middleware('auth'); //Home - To-Do-List feed based off User ID
Route::get('/delete/{id}', 'UserController@delete')->middleware('auth'); //Delete - Based off ID and User ID
Route::get('/complete/{id}', 'UserController@complete')->middleware('auth'); //Complete - Changes Active from 0 to 1; Pseodo-Delete;
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware('auth');

// Route::get('/', 'HomeController@index')->name('home');

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

Route::get('/', function () {
    return view('welcome');
	})->name('root');

Route::resource('articles','ArticlesController');

Route::resource('comments', 'CommentsController');

Route::get('profile', 'StaticsController@profile')->name('profile');

Route::get('home', 'StaticsController@home')->name('home');
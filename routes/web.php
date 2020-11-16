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
    //return view('welcome');
    return redirect('/home',302);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/edit/{userId}', 'HomeController@edit')->name('edit');
Route::put('/edit/{userId}', 'HomeController@update')->name('update');

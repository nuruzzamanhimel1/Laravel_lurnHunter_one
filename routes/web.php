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


Route::get('/', 'PostController@index')->name('index');

Route::get('/delete_info/{id}', 'PostController@delete_info_method')->name('delete_info');

Route::post('/insert_post', 'PostController@insert_post_method')->name('insert_post');
Route::post('/update_post/{id}', 'PostController@update_post_method')->name('update_post');


Route::post('/update/password', 'HomeController@update_password_method')->name('update.password');
Route::get('/change_password', 'HomeController@change_password_method')->name('change_password');
Auth::routes();


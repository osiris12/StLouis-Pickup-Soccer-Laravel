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

Route::get('/',  'HomeController@index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/vote', 'FieldsController@vote');
Route::post('/vote', 'FieldsController@vote');
Route::get('/account', 'UserController@index')->name('my_account'); 
Route::post('/home', 'UserController@store_image')->name('store_image');
Route::post('/info', 'UserController@addUserInfo');
Route::get('/account/{id}', 'UserController@displayUserPage');
Route::get('/testing', function(){
    return view('testing');
});
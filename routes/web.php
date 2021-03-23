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
});
Route::get('/property/{id}','PropertyController@property');
Route::resources(['api-properties' => PropertyController::class]);
Auth::routes();

Route::get('/api-properties-user', 'PropertyController@properties');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/properties-user', 'PropertiesUserController@index')->name('properties-user');
Route::get('/categories', 'CategorieController@categories')->name('categories');

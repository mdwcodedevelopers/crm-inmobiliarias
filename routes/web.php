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

Route::get('/','WelcomeController@index');
Route::get('/property/{id}','PropertyController@property');
Route::get('/property-images/{id}','ImageController@images');
Route::put('/property-images-set/{id}','ImageController@setimage');
Route::post('/company-image/{id}','CompanyController@setimage');
Route::post('/api-password','UserController@updatepassword');
Route::get('/currency','CurrencyController@view');
Route::get('/company','CompanyController@view');
Route::get('/users','UsersController@view');
Route::resources(['api-properties' => PropertyController::class,
'api-status'=>StatusController::class,
'api-currency'=>CurrencyController::class,
'api-images'=>ImageController::class,
'api-users'=>UsersController::class,
'api-user'=>UserController::class,
'api-company'=>CompanyController::class,
'api-dashboard'=>DashboardController::class]);
Auth::routes();

Route::get('/api-properties-user', 'PropertyController@properties');
Route::get('/profile', 'UserController@view');
Route::get('/api-properties-admin', 'PropertyController@propertiesAdmin');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/properties-user', 'PropertiesUserController@index')->name('properties-user');
Route::get('/categories', 'CategorieController@categories')->name('categories');
Route::get('/status', 'StatusViewController@index')->name('status');


Route::resource('/interesed', OportunityController::class);
Route::get('/api-contacts','OportunityController@getContacts');

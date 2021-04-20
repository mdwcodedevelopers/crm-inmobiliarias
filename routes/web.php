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

Route::get('register/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('register/verify/{id}/{hash}', 'Auth\VerificationController@index')->name('verification.verify');
Route::post('register/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Auth::routes(['verify' => true]);
Route::get('/','WelcomeController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/property/{id}','PropertyController@property');
    Route::get('/property-images/{id}','ImageController@images');
    Route::put('/property-images-set/{id}','ImageController@setimage');
    Route::post('/company-image/{id}','CompanyController@setimage');
    Route::post('/api-password/{id}','UsersController@updatepassword');
    Route::get('/currency','CurrencyController@view');
    Route::get('/company','CompanyController@view');
    Route::get('/users','UsersController@view');
    Route::get('/oportunities', "OportunityController@view");
    Route::get('/contacts/tags', "TagController@view");
    Route::get('/config', "ConfigController@index");
    Route::resources(['api-properties' => PropertyController::class,
    'api-status'=>StatusController::class,
    'api-status-oportunities'=>StatusOportunitiesController::class,
    'api-currency'=>CurrencyController::class,
    'api-images'=>ImageController::class,
    'api-users'=>UsersController::class,
    'api-user'=>UserController::class,
    'api-company'=>CompanyController::class,
    'api-service'=>ServiceController::class,
    'api-environment'=>EnvironmentController::class,
    'api-dashboard'=>DashboardController::class,
    'api-oportunities'=>OportunityController::class]);
    Auth::routes();

    Route::get('/api-properties-user', 'PropertyController@properties');
    Route::get('/users', 'UserController@view');
    Route::get('/profile', 'UserController@profile');
    Route::get('/reports', 'ReportController@view');
    Route::get('/categories', 'CategorieController@categories')->name('categories');
    Route::get('/status', 'StatusViewController@index')->name('status');
    Route::get('/api-properties-admin', 'PropertyController@propertiesAdmin');


    Route::get('/api-properties-user', 'PropertyController@properties');
    Route::get('/property-user/{id}', 'PropertyController@edit');
    Route::patch('/property-user/{id}', 'PropertyController@update');
    Route::get('/properties-user', 'PropertiesUserController@index')->name('properties-user');



    Route::put('/api-oportunities/close/{id}', 'OportunityController@closeOportunity');
    Route::get('/api-contacts','OportunityController@getContacts');
    Route::get('/api-notes/{id}','NoteController@show');
    Route::post('/api-notes','NoteController@store');
    Route::post('/api-oportunities/sendMail','OportunityController@sendEmail');
});

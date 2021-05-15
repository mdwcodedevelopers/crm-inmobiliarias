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
Route::post('/api-contacts-property', 'UsersController@propertyContact');
Route::get('/api-user-info', 'UsersController@myUser');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/property-images/{id}','ImageController@images');
    Route::put('/property-images-set/{id}','ImageController@setimage');

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/property/{id}','PropertyController@property');
    Route::post('/company-image/{id}','CompanyController@setimage');
    Route::post('/api-password/{id}','UsersController@updatepassword');
    Route::get('/currency','CurrencyController@view');
    Route::get('/company','CompanyController@view');
    Route::get('/users','UsersController@view');
    Route::get('/oportunities', "OportunityController@view");
    Route::get('/contacts', "ContactController@view");
    Route::get('/contacts/tags', "TagController@view");
    Route::get('/config', "ConfigController@index");
    Route::get('/events', "EventController@view");
    Route::resources([
    'api-properties' => PropertyController::class,
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
    'api-oportunities'=>OportunityController::class,
    'api-contacts'=>ContactController::class,
    'api-tags'=>TagController::class,
    'api-group-tags'=>GroupTagController::class,
    'api-event-types'=>EventTypesController::class,
    'api-events'=>EventController::class]);
    Auth::routes();

    Route::get('/api-properties-user', 'PropertyController@properties');
    Route::get('/users', 'UserController@view');
    Route::get('/profile', 'UserController@profile');
    Route::get('/categories', 'CategorieController@categories')->name('categories');
    Route::get('/status', 'StatusViewController@index')->name('status');
    Route::get('/api-properties-admin', 'PropertyController@propertiesAdmin');

    Route::get('/api-properties-user', 'PropertyController@properties');
    Route::get('/property-user/{id}', 'PropertyController@edit');
    Route::get('/api-contacts-search', 'ContactController@search');
    Route::patch('/property-user/{id}', 'PropertyController@update');
    Route::get('/properties-user', 'PropertiesUserController@index')->name('properties-user');

    Route::put('/api-oportunities/close/{id}', 'OportunityController@closeOportunity');
    // Route::get('/api-contacts','OportunityController@getContacts');
    Route::get('/api-notes/{id}','NoteController@show');
    Route::post('/api-notes','NoteController@store');
    Route::post('/api-oportunities/sendMail','OportunityController@sendEmail');

    Route::get('/reports', 'ReportController@index');
    Route::get('/reports/created', 'ReportController@created');
    Route::get('/reports/view', 'ReportController@view');
    Route::get('/reports/historical', 'ReportController@historical');
    Route::get('/reports/property/{id}', 'ReportController@propertyPDF');
    Route::get('/reports/contacts-pdf', 'ReportController@contactsPDF');
    Route::post('/api-contacts/export', 'ContactController@exportXLS');

    Route::get('/environments/init', 'EnvironmentController@init');
    Route::resource('environments', 'EnvironmentController');
    Route::get('/services/init', 'ServiceController@init');
    Route::resource('services', 'ServiceController');
});

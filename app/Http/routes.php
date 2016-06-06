<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(array('prefix' => 'api/v1/admin'), function()
	{
    	Route::resource('audiobooks', 'AudioBooksController');
		Route::resource('reviews', 'ReviewsController');
		Route::resource('chapters', 'AudioBookChaptersController');
		Route::resource('bundles', 'BundlesController');
		Route::resource('categories', 'CategoriesController');
		Route::resource('collections', 'CollectionsController');
		Route::resource('purchases', 'PurchasesController');
		Route::resource('auth', 'AuthenticateController');
		Route::resource('users', 'UsersController');
		
		Route::post('auth/login', 'AuthenticateController@login');
		Route::group(array('prefix' => '/user/'), function()
		{
			Route::get('viewall', 'UsersController@viewall');
			Route::post('create', 'UsersController@create');
			Route::post('edit/{id}', 'UsersController@edit');
			Route::get('view/{id}', 'UsersController@show');
			Route::get('delete/{id}', 'UsersController@destroy');
		
		});
	});
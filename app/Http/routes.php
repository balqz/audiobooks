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
		Route::resource('reviews', 'ReviewsController');
		Route::resource('chapters', 'AudioBookChaptersController');
		Route::resource('bundles', 'BundlesController');
		Route::resource('collections', 'CollectionsController');
		Route::resource('purchases', 'PurchasesController');
		Route::resource('auth', 'AuthenticateController');
		
		Route::post('auth/login', 'AuthenticateController@login');
		//user
		Route::group(array('prefix' => '/user/'), function()
		{
			Route::get('viewall',['as' => 'user', 'uses' => 'UsersController@viewall']);
			Route::post('create',['as' => 'user', 'uses' => 'UsersController@create']);
			Route::post('edit/{id}',['as' => 'user', 'uses' => 'UsersController@edit']);
			Route::get('view/{id}',['as' => 'user', 'uses' => 'UsersController@show']);
			Route::get('delete/{id}',['as' => 'user', 'uses' => 'UsersController@destroy']);
		
		});
		Route::resource('users', 'UsersController');
		//audiobooks
		Route::group(array('prefix' => '/audiobooks/'), function()
		{
			Route::get('viewall',['as' => 'audiobook', 'uses' => 'AudioBooksController@viewall']);
			Route::get('view/{id}',['as' => 'audiobook', 'uses' => 'AudioBooksController@show']);
			Route::post('edit/{id}',['as' => 'audiobook', 'uses' => 'AudioBooksController@edit']);
			Route::post('create',['as' => 'audiobook', 'uses' => 'AudioBooksController@create']);
			Route::get('delete/{id}',['as' => 'audiobook', 'uses' => 'AudioBooksController@delete']);
		
		});
		Route::resource('audiobooks', 'AudioBooksController');
		//category
		Route::group(array('prefix' => '/categories/'), function()
		{
			Route::post('create',['as' => 'categories', 'uses' => 'CategoriesController@create']);
			Route::post('edit/{id}',['as' => 'categories', 'uses' => 'CategoriesController@edit']);
			Route::get('view/{id}',['as' => 'categories', 'uses' => 'CategoriesController@show']);
			Route::get('viewall',['as' => 'categories', 'uses' => 'CategoriesController@viewall']);
			Route::get('delete/{id}',['as' => 'categories', 'uses' => 'CategoriesController@delete']);
		
		});
		Route::resource('categories', 'CategoriesController');
	});
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/login', 'LoginController@getIndex');
Route::post('/login', 'LoginController@postIndex');
Route::group(array('prefix' => 'user'), function()
{
    Route::get('dashboard', 'UserDashboardController@getIndex');
    Route::group(array('prefix' => 'apply'), function() {
    	Route::get('cash-advance', 'UserDashboardController@getApplyCA');
    	Route::post('cash-advance', 'UserDashboardController@postApplyCA');
    });
    Route::get('transactions/{id}', 'UserDashboardController@getTransactions');
    Route::post('transactions/{id}', 'UserDashboardController@postTransactions');
});
Route::group(array('prefix' => 'divhead'), function()
{
	Route::get('dashboard', 'DivHeadDashboardController@getIndex');
	Route::get('transactions/{id}', 'DivHeadDashboardController@getTransactions');
	Route::post('transactions/{id}', 'DivHeadDashboardController@postTransactions');
});
Route::group(array('prefix' => 'depthead'), function()
{
	Route::get('dashboard', 'DeptHeadDashboardController@getIndex');
	Route::get('transactions/{id}', 'DeptHeadDashboardController@getTransactions');
	Route::post('transactions/{id}', 'DeptHeadDashboardController@postTransactions');
});
Route::group(array('prefix' => 'grouphead'), function()
{
	Route::get('dashboard', 'GroupHeadDashboardController@getIndex');
	Route::get('transactions/{id}', 'GroupHeadDashboardController@getTransactions');
	Route::post('transactions/{id}', 'GroupHeadDashboardController@postTransactions');
});
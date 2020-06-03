<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:web')->get('/', function () {
    return view('vue');
});

Route::get('/coba', function() {
	return view('coba');
});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::middleware('auth:web')->prefix('v1')->group(function() {
	Route::get('statistic/finance', 'StatisticController@finanial');
	Route::get('statistic/category', 'StatisticController@category');
	Route::get('statistic/period-chart', 'StatisticController@periodChart');
	Route::get('users/names', function(){
		return ['data' => App\User::pluck('name')];
	});
	
	Route::resource('category', 'CategoryController');
	Route::resource('finance', 'FinancialController');
});
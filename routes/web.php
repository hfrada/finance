<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:super_user')->get('/admin', function () {return view('vue');});

// Route::get('/coba', function() {
// 	return view('coba');
// });

Auth::routes();

// Route::get('/', 'HomeController@index');

Route::get('/admin', function() {return view('vue');})->name('adminPage');
Route::get('/admin-login', 'Auth\AdminLoginController@loginForm');
Route::post('/admin-login', [
	'as' => 'admin-login',
	'uses' => 'Auth\AdminLoginController@login'
]);

Route::middleware('auth:super_user')->prefix('v1')->group(function() {
	// Statistic
	Route::get('statistic/financial', 'StatisticController@financial');
	// Route::get('statistic/category', 'StatisticController@category');
	Route::get('statistic/period-chart', 'StatisticController@periodChart');
	
	// Single Data
	Route::get('admin/data', 'SingleDataController@roleData');

	// Resource Data
	Route::resource('role', 'RoleController');
	
	// Route::middleware('permission:financial,category')->group(function() {
		Route::get('user/names', 'SingleDataController@userNames');
		Route::resource('category', 'CategoryController')->middleware('permission:category');
		Route::resource('financial', 'FinancialController')->middleware('permission:financial');
	// });
});
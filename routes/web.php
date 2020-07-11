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

// Route::get('/login', function() {
// 	return view('auth\login');
// });

Auth::routes();

// Route::get('/', 'HomeController@index');

Route::get('/admin-login', 'Auth\AdminLoginController@loginForm')->name('adminLogin');
Route::post('/admin-login', [
	'as' => 'admin-login',
	'uses' => 'Auth\AdminLoginController@login'
]);

Route::middleware('auth:super_user')->get('/admin', function () { return view('vue'); })->name('adminPage');

Route::middleware('auth:super_user')->prefix('v1')->group(function() {

	Route::get('statistic/financial', 'StatisticController@financial');
	// Route::get('statistic/category', 'StatisticController@category');
	Route::get('statistic/period-chart', 'StatisticController@periodChart');

	Route::get('logout', 'Auth\AdminLoginController@logout');

	Route::resource('role', 'RoleController');
	
	Route::middleware('permission:category,financial')->group(function() {
		Route::middleware('permission:financial')->resource('financial', 'FinancialController');
		Route::middleware('permission:category')->resource('category', 'CategoryController');
	});
});

Route::middleware('auth:super_user')->prefix('store')->group(function() {
	Route::get('user/name', 'SingleDataController@userNames');
	Route::get('permissions', 'SingleDataController@getPermission');
	Route::get('category', 'SingleDataController@getCategory');
	Route::get('admin/data', 'SingleDataController@roleData');
});
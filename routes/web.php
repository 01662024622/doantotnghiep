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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', 'ProductController');

Route::resource('users', 'UserController');

Route::resource('categories', 'CategoryController');

Route::resource('apartments', 'ApartmentController');

Route::post('categories/{id}', 'CategoryController@update');
Route::post('products/{id}', 'ProductController@update');



Route::group(['prefix' => 'api/v1'], function() {

	Route::get('product/table', 'DataBaseApi\DataTableController@product')->name('product.api.data');
	Route::get('category/table', 'DataBaseApi\DataTableController@category')->name('category.api.data');
	Route::get('users/table', 'DataBaseApi\DataTableController@users')->name('users.api.data');

	Route::get('apartments/table', 'DataBaseApi\DataTableController@apartments')->name('apartments.api.data');



	Route::get('consts/table', 'DataBaseApi\DataTableController@consts')->name('consts.api.data');
	Route::get('rating/table', 'DataBaseApi\DataTableController@rating')->name('rating.api.data');

});

Route::group(['prefix' => 'api/status'], function() {


	Route::get('categories/{id}', 'status\StatusController@categories')->name('categories.api.status');
	Route::get('products/{id}', 'status\StatusController@products')->name('products.api.status');
		Route::get('apartments/{id}', 'status\StatusController@apartments')->name('apartments.api.status');

	Route::post('users/{id}', 'status\StatusController@users')->name('users.api.status');



});





Route::view('dashboard', 'ai.chart');
Route::get('chart/avg', 'DataBaseApiChart@average');
Route::get('pie/avg', 'DataBaseApiChart@average2');

Route::resource('rates', 'RatingController');
Route::resource('consts', 'ConstController');

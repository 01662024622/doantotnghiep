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

Route::resource('categories', 'CategoryController');

Route::post('categories/{id}', 'CategoryController@update');
Route::post('products/{id}', 'ProductController@update');



Route::group(['prefix' => 'api/v1'], function() {

    Route::get('product/table', 'DataBaseApi\DataTableController@product')->name('product.api.data');
    Route::get('category/table', 'DataBaseApi\DataTableController@category')->name('category.api.data');

});
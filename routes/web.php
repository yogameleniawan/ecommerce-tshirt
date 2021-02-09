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

Auth::routes();

Route::get('/logout', function () {
    $data = Auth::logout();
    return view('auth.login');
});


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/shop', 'HomeController@transaction')->name('transaction');
Route::get('/shop/{id}/order', 'HomeController@show')->name('shop.order');
Route::get('/carts', 'CartController@index')->name('carts');
Route::get('/carts/{id}/checkout', 'CartController@edit')->name('cart.checkout');
Route::get('/carts/{id}/rate', 'UserController@edit')->name('cart.rate');
Route::get('/carts/{id}/receipt', 'CartController@receipt')->name('cart.receipt');

Route::get('/manage', 'AdminController@index')->name('admin');
Route::get('/admin/user', 'AdminController@user')->name('users');
Route::get('/admin/user/{id}/edit', 'AdminController@edit')->name('admin.edit');

Route::get('/admin/item', 'ItemController@index')->name('items');
Route::get('/admin/item/{id}/edit', 'ItemController@edit')->name('item.editItem');
Route::post('/admin/item/{id}/edit', 'ItemController@edit')->name('post.editItem');

Route::get('/admin/transaction', 'TransactionController@index')->name('admin.transaction');
Route::get('/admin/transaction/{id}/process', 'TransactionController@edit');
Route::get('/admin/profile', 'UserController@index')->name('name.profile');
Route::get('/user/profile', 'UserController@show')->name('user.profile');

Gate::define('admin', function ($user) {
    return $user->roles == "admin" || $user->roles == "staff";
});

Route::get('exportView', 'ExcelController@exportView');
Route::get('export', 'ExcelController@export')->name('export');

Route::resource('admin', 'AdminController');
Route::resource('item', 'ItemController');
Route::resource('transaction', 'TransactionController');
Route::resource('cart', 'CartController');
Route::resource('user', 'UserController');
Route::resource('home', 'HomeController');

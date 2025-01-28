<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('/proses', 'App\Http\Controllers\LoginController@proses')->name('proses.login');
Route::get('/logOut', 'App\Http\Controllers\LoginController@logOut')->name('logOut.login');

Route::get('/create', 'App\Http\Controllers\Admin\UserController@create')->name('register.user');
Route::post('/store', 'App\Http\Controllers\Admin\UserController@store')->name('store.user');


Route::get('/produkCustomer', 'App\Http\Controllers\Customer\ProdukController@index')->name('customer.produk');

Route::get('/dashboardAdmin', 'App\Http\Controllers\DashboardController@index')->name('index.dashboard');
Route::get('/produkAdmin', 'App\Http\Controllers\Admin\ProdukController@index')->name('admin.produk');
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

//----------------------------------= CUSTOMER = ----------------------------------------------------------------------------
Route::prefix('customer')->middleware(['auth', 'status:customer'])->group(function(){
    Route::get('/produkCustomer', 'App\Http\Controllers\Customer\ProdukController@index')->name('customer.produk');

    // KERANJANG
    Route::get('/tambahKeranjang{id}', 'App\Http\Controllers\Customer\KeranjangController@tambahKeranjang')->name('pesan.produk'); //Proses setelah di halaman Produk qt klik masukkan keranjang ke suatu produk
    Route::get('/keranjangCustomer', 'App\Http\Controllers\Customer\KeranjangController@index')->name('customer.keranjang'); //Tampilan Keranjang
    Route::get('/checkoutKeranjang/{id}/{idProduk}', 'App\Http\Controllers\Customer\KeranjangController@checkoutKeranjang')->name('pesan.checkout');
    Route::put('/bayarCheckout{id}', 'App\Http\Controllers\Customer\KeranjangController@bayarKeranjang')->name('bayar.checkout');
    
    Route::post('/midtransCallback', 'App\Http\Controllers\Customer\CallbackController@callback')->name('midtrans.callback');

    // RIWAYAT
    Route::get('/riwayatCustomer', 'App\Http\Controllers\Customer\KeranjangController@riwayat')->name('customer.riwayat'); //Tampilan Keranjang
});

// ----------------------------------------= ADMIN =-------------------------------------------------------------------------

    Route::get('/dashboardAdmin', 'App\Http\Controllers\DashboardController@index')->name('index.dashboard');

    // PRODUK
    Route::get('/produkAdmin', 'App\Http\Controllers\Admin\ProdukController@index')->name('admin.produk');
    Route::get('/createProduk', 'App\Http\Controllers\Admin\ProdukController@create')->name('create.produk');
    Route::post('/storeProduk', 'App\Http\Controllers\Admin\ProdukController@store')->name('store.produk');
    Route::get('/editProduk/{id}', 'App\Http\Controllers\Admin\ProdukController@edit')->name('edit.produk');
    Route::put('/updateProduk/{id}', 'App\Http\Controllers\Admin\ProdukController@update')->name('update.produk');
    Route::delete('/deleteProduk/{id}', 'App\Http\Controllers\Admin\ProdukController@delete')->name('destroy.produk');

    // CUSTOMER
    Route::get('/dataCustomer', 'App\Http\Controllers\Admin\CustomerController@index')->name('admin.customer');

    // KERANJANG
    Route::get('/ProdukTerjual', 'App\Http\Controllers\Admin\KeranjangController@index')->name('admin.keranjang');

    // LAPORAN
    Route::get('/AdminLaporan', 'App\Http\Controllers\Admin\LaporanController@index')->name('admin.laporan');
    Route::get('/ProsesLaporan', 'App\Http\Controllers\Admin\LaporanController@proses')->name('proses.laporan');
    Route::get('/CetakLaporan', 'App\Http\Controllers\Admin\LaporanController@exportPDF')->name('cetak.laporan');

    
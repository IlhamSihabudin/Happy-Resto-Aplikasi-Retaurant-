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

Route::get('/', function () {
    return redirect()->route('pelanggan.home');
});

Route::get('/login_validate', function (){
   if (Auth::check()){
       if (Auth::user()->id_level == '1'){
           return redirect()->route('admin.home');
       }elseif(Auth::user()->id_level == '2'){
           return redirect()->route('waiter.home');
       }elseif (Auth::user()->id_level == '3'){
           return redirect()->route('kasir.home');
       }elseif (Auth::user()->id_level == '4'){
           return redirect()->route('owner.home');
       }
       return redirect()->route('login');
   }

   return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['web', 'admin']], function(){
    Route::get('/', 'HomeController@admin')->name('admin.home');

    //User
    Route::group(['prefix'=>'user'], function (){
        Route::get('/', 'UserController@index')->name('user');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/create', 'UserController@store')->name('user.store');
        Route::get('/edit/{user}', 'UserController@edit')->name('user.edit');
        Route::patch('/edit/{user}', 'UserController@update')->name('user.update');
        Route::get('/destroy/{user}', 'UserController@destroy')->name('user.destroy');
        Route::get('/change_password/{user}', 'UserController@change_password')->name('user.change_password');
        Route::patch('/change_password/{user}', 'UserController@update_password')->name('user.update_password');
    });

    //Masakan
    Route::group(['prefix'=>'masakan'], function (){
        Route::get('/', 'MasakanController@index')->name('masakan');
        Route::get('/create', 'MasakanController@create')->name('masakan.create');
        Route::post('/create', 'MasakanController@store')->name('masakan.store');
        Route::get('/edit/{masakan}', 'MasakanController@edit')->name('masakan.edit');
        Route::patch('/edit/{masakan}', 'MasakanController@update')->name('masakan.update');
        Route::get('/destroy/{masakan}', 'masakanController@destroy')->name('masakan.destroy');
    });

    //Meja
    Route::group(['prefix'=>'meja'], function (){
        Route::get('/', 'MejaController@index')->name('meja');
        Route::get('/create', 'MejaController@create')->name('meja.create');
        Route::post('/create', 'MejaController@store')->name('meja.store');
        Route::get('/edit/{meja}', 'MejaController@edit')->name('meja.edit');
        Route::patch('/edit/{meja}', 'MejaController@update')->name('meja.update');
        Route::get('/destroy/{meja}', 'MejaController@destroy')->name('meja.destroy');
    });
});

Route::group(['prefix'=>'waiter'], function (){
    Route::get('/', 'HomeController@waiter')->name('waiter.home');
    Route::get('/batalkan/{order}', 'HomeController@batalkan')->name('waiter.batalkan');
    Route::get('/antar_masakan/{detailOrder}', 'HomeController@antar_masakan')->name('waiter.antar_masakan');

    //Order
    Route::group(['prefix'=>'order'], function (){
        Route::get('/', 'OrderController@index')->name('order');
        Route::post('/', 'OrderController@order')->name('order.pesan');
        Route::get('/menu/{idOrder}', 'OrderController@select_menu')->name('order.select_menu');

        //detail_order
        Route::post('/menu/{idOrder}', 'DetailOrderController@store')->name('order.store_keranjang');
        Route::get('/menu/destroy/{detailOrder}', 'DetailOrderController@destroy')->name('order.keranjang.destroy');
        Route::get('/menu/pesan/{idOrder}', 'DetailOrderController@pesan')->name('order.pesan_masakan');
        Route::get('/pesanan/{idOrder}', 'DetailOrderController@list_pesanan')->name('order.list_pesanan');
    });
});

Route::group(['prefix'=>'kasir'], function (){
    Route::get('/', 'HomeController@kasir')->name('kasir.home');

    //Transaksi
    Route::group(['prefix'=>'transaksi'], function (){
        Route::get('/', 'TransaksiController@index')->name('transaksi');
        Route::post('/cari', 'TransaksiController@cari')->name('transaksi.cari');
        Route::get('/{idOrder}', 'TransaksiController@show_pesanan')->name('transaksi.show_pesanan');
        Route::post('/kasir/{idOrder}', 'TransaksiController@store')->name('transaksi.store');
        Route::get('/struk/{idTransaksi}/{bayar}', 'TransaksiController@struk')->name('transaksi.struk');
    });
});

Route::group(['prefix'=>'owner'], function (){
    Route::get('/', 'HomeController@owner')->name('owner.home');

    //Laporan
    Route::get('/laporan', 'LaporanController@index')->name('laporan');
    Route::get('/laporan/{tahun}', 'LaporanController@filter_year')->name('laporan.filter');
    Route::get('/pertanggal/', 'LaporanController@pertanggal')->name('laporan.pertanggal');
    Route::get('/pertanggal/{tglAwal}/{tglAkhir}', 'LaporanController@store_pertanggal')->name('laporan.store_pertanggal');
    Route::get('/transaksi', 'LaporanController@show_transaksi')->name('laporan.show_transaksi');
});

Route::group(['prefix'=>'pelanggan'], function (){
    Route::get('/', 'PelangganController@index')->name('pelanggan.home');
    Route::post('/', 'PelangganController@pilih_meja')->name('pelanggan.pilih_meja');
    Route::get('dashboard/{idMeja}', 'PelangganController@dashboard')->name('pelanggan.dashboard');
    Route::get('/{idMeja}', 'PelangganController@order')->name('pelanggan.order');

    //Order
    Route::group(['prefix'=>'order'], function (){
        Route::post('/', 'OrderController@order')->name('order.pesan');
        Route::get('/menu/{idOrder}', 'OrderController@select_menu')->name('order.select_menu');

        //detail_order
        Route::post('/menu/{idOrder}', 'DetailOrderController@store')->name('order.store_keranjang');
        Route::get('/menu/destroy/{detailOrder}', 'DetailOrderController@destroy')->name('order.keranjang.destroy');
        Route::get('/menu/pesan/{idOrder}', 'DetailOrderController@pesan')->name('order.pesan_masakan');
        Route::get('/pesanan/{idOrder}', 'DetailOrderController@list_pesanan')->name('order.list_pesanan');
    });
});


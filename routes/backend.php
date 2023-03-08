<?php

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
|
*/

use Illuminate\Support\Facades\Route;

Route::get(config('master.aplikasi.author').'/{folder}/{file}', 'jsController@backend');
Route::get(config('master.aplikasi.author').'/{folder}/{id}/{file}', 'jsController@backendWithId');
Route::get(config('master.aplikasi.author').'/{folder}/{link}/{kode}/{file}', 'jsController@backendWithKode');

Route::get('/home', 'berandaController@index')->name('beranda.home');
Route::group(['prefix' => config('master.url.admin')], function () {
	// dashboard - beranda
	// Route::get('/', 'berandaController@index')->name('beranda.index');

	// Url Public
    Route::group(['middleware' => ['throttle:5']], function () {
		Route::post('lock-screen', 'userController@lockScreen');
    });
	//user ubah password
	Route::get('user/ubahpassword/{id}', 'userController@ubahpassword')->name('user.ubahpassword');
	Route::group(['middleware' => ['throttle:10']], function () {
		Route::post('user/ubahpassword', 'userController@resetpassword')->name('user.store_ubahpassword');
	});
	Route::group(['middleware' => ['aksesmenu']], function () {
        //user
        Route::get('user/hapus/{id}', 'userController@hapus')->name('user.hapus');
        Route::get('user/data', 'userController@data')->name('user.data');
        Route::resource('user', 'userController');
        //menu
        Route::get('menu/hapus/{id}', 'menuController@hapus')->name('menu.hapus');
        Route::get('menu/data', 'menuController@data')->name('menu.data');
        Route::post('menu/susun-menu', 'menuController@susunMenu')->name('menu.susun-menu');
        Route::get('menu/extract-menu', 'menuController@extract')->name('menu.extract-menu');
        Route::resource('menu', 'menuController');
        //aksesgrup
        Route::get('aksesgrup/hapus/{id}', 'aksesgrupController@hapus')->name('aksesgrup.hapus');
        Route::get('aksesgrup/data', 'aksesgrupController@data')->name('aksesgrup.data');
        Route::get('aksesgrup/detail/data/{id}', 'aksesgrupController@data_detail')->name('aksesgrup.data_detail');
        Route::resource('aksesgrup', 'aksesgrupController');
        //aksesmenu
        Route::get('aksesmenu/data/{id}', 'aksesmenuController@data')->name('aksesmenu.data');
        Route::get('aksesmenu/create/{id}', 'aksesmenuController@create')->name('aksesmenu.create_id');
        Route::resource('aksesmenu', 'aksesmenuController');
        
        // slider
        Route::prefix('slider')->as('slider')->group(function () {
            Route::get('/data', 'sliderController@data');
            Route::get('/hapus/{id}', 'sliderController@hapus');
        });
        Route::resource('slider', 'sliderController');

        // kontak
        Route::prefix('kontak')->as('kontak')->group(function () {
            Route::get('/data', 'kontakController@data');
            Route::get('/hapus/{id}', 'kontakController@hapus');
        });
        Route::resource('kontak', 'kontakController');

        // opd
        Route::prefix('opd')->as('opd')->group(function () {
            Route::get('/data', 'opdController@data');
            Route::get('/hapus/{id}', 'opdController@hapus');
        });
        Route::resource('opd', 'opdController');
        
        // jabatan
        Route::prefix('jabatan')->as('jabatan')->group(function () {
            Route::get('/data', 'jabatanController@data');
            Route::get('/hapus/{id}', 'jabatanController@hapus');
        });
        Route::resource('jabatan', 'jabatanController');
        
        // bidang
        Route::prefix('bidang')->as('bidang')->group(function () {
            Route::get('/data', 'bidangController@data');
            Route::get('/hapus/{id}', 'bidangController@hapus');
        });
        Route::resource('bidang', 'bidangController');

        // kegiatan
        Route::prefix('kegiatan')->as('kegiatan')->group(function () {
            Route::get('/data', 'kegiatanController@data');
            Route::get('/hapus/{id}', 'kegiatanController@hapus');
        });
        Route::resource('kegiatan', 'kegiatanController');

        // nomorterakhir
        Route::prefix('nomorterakhir')->as('nomorterakhir')->group(function () {
            Route::get('/data', 'nomorTerakhirController@data');
            Route::get('/hapus/{id}', 'nomorTerakhirController@hapus');
        });
        Route::resource('nomorterakhir', 'nomorTerakhirController');
        
        // pegawai
        Route::prefix('pegawai')->as('pegawai')->group(function () {
            Route::get('/data', 'pegawaiController@data');
            Route::get('/hapus/{id}', 'pegawaiController@hapus');
        });
        Route::resource('pegawai', 'pegawaiController');

        // sptmasuk
        Route::prefix('sptmasuk')->as('sptmasuk')->group(function () {
            Route::get('/data', 'sptController@data');
            Route::get('/hapus/{id}', 'sptController@hapus');
        });
        Route::resource('sptmasuk', 'sptController');
        
        // sptkeluar
        Route::prefix('sptkeluar')->as('sptkeluar')->group(function () {
            Route::get('/data', 'sptKeluarController@data');
            Route::get('/hapus/{id}', 'sptKeluarController@hapus');
            Route::get('/getrekening/{id}', 'sptKeluarController@getrekening');
        });
        Route::resource('sptkeluar', 'sptKeluarController');
        
        // aplikasi
        Route::prefix('aplikasi')->as('aplikasi')->group(function () {
            Route::get('/data/{id?}', 'aplikasiController@data');
            Route::get('/logo/{id}', 'aplikasiController@logo');
            Route::post('/store_logo', 'aplikasiController@store_logo');
            Route::get('/favicon/{id}', 'aplikasiController@favicon');
            Route::post('/store_favicon', 'aplikasiController@store_favicon');
        });
        Route::resource('aplikasi', 'aplikasiController');   

    });
});

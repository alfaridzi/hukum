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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
	return view('login');
});

Route::get('/dashboard', function() {
	return view('dashboard');
});

Route::get('/pengaturan/text-tombol', 'Pengaturan\TextTombolController@index');
Route::post('/pengaturan/text-tombol/edit', 'Pengaturan\TextTombolController@edit');

Route::get('/pengaturan/satuan-unit', 'Pengaturan\SatuanUnitController@index');
Route::post('/pengaturan/satuan-unit/tambah', 'Pengaturan\SatuanUnitController@tambah');
Route::post('/pengaturan/satuan-unit/edit', 'Pengaturan\SatuanUnitController@edit');
Route::delete('/pengaturan/satuan-unit/delete/{id}', 'Pengaturan\SatuanUnitController@delete');

Route::get('/pengaturan/grup-jabatan', 'Pengaturan\GrupJabatanController@index');
Route::post('/pengaturan/grup-jabatan/tambah', 'Pengaturan\GrupJabatanController@tambah');
Route::post('/pengaturan/grup-jabatan/edit', 'Pengaturan\GrupJabatanController@edit');
Route::delete('/pengaturan/grup-jabatan/delete/{id}', 'Pengaturan\GrupJabatanController@delete');

Route::get('/pengaturan/isi-disposisi', 'Pengaturan\IsiDisposisiController@index');
Route::post('/pengaturan/isi-disposisi/tambah', 'Pengaturan\IsiDisposisiController@tambah');
Route::post('/pengaturan/isi-disposisi/edit', 'Pengaturan\IsiDisposisiController@edit');
Route::delete('/pengaturan/isi-disposisi/delete/{id}', 'Pengaturan\IsiDisposisiController@delete');

Route::get('/pengaturan/halaman-depan', 'Pengaturan\HalamanDepanController@index');
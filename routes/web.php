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

Route::middleware(['guest'])->group(function(){
	Route::get('/', 'Login\LoginController@index');

	Route::post('/login', 'Login\LoginController@login');
});



Route::get('unitkerja','unitKerjaController@unitKerja');

Route::post('unitkerja/tambah','unitKerjaController@tambahUnitKerja');

Route::get('unitkerja/delete/{id}', 'unitKerjaController@deleteData');

Route::post('unitkerja/update/{id}','unitKerjaController@updateUnitKerja');



Route::get('klasifikasi','klasifikasiController@klasifikasi');

Route::post('klasifikasi/tambah','klasifikasiController@tambahKlasifikasi');

Route::get('klasifikasi/delete/{id}', 'klasifikasiController@deleteData');

Route::post('klasifikasi/update/{id}','klasifikasiController@updateKlasifikasi');


/* ------------------------- Bagian Pengaturan ----------------------------------- */

Route::get('/pengaturan/bahasa', 'Pengaturan\BahasaController@index');
Route::post('/pengaturan/bahasa/tambah', 'Pengaturan\BahasaController@tambah');
Route::post('/pengaturan/bahasa/edit', 'Pengaturan\BahasaController@edit');
Route::delete('/pengaturan/bahasa/{id}/delete', 'Pengaturan\BahasaController@delete');

Route::get('/pengaturan/jenis-naskah', 'Pengaturan\JenisNaskahController@index');
Route::post('/pengaturan/jenis-naskah/tambah', 'Pengaturan\JenisNaskahController@tambah');
Route::post('/pengaturan/jenis-naskah/edit', 'Pengaturan\JenisNaskahController@edit');
Route::delete('/pengaturan/jenis-naskah/{id}/delete', 'Pengaturan\JenisNaskahController@delete');

Route::get('/pengaturan/media-arsip', 'Pengaturan\MediaArsipController@index');
Route::post('/pengaturan/media-arsip/tambah', 'Pengaturan\MediaArsipController@tambah');
Route::post('/pengaturan/media-arsip/edit', 'Pengaturan\MediaArsipController@edit');
Route::delete('/pengaturan/media-arsip/{id}/delete', 'Pengaturan\MediaArsipController@delete');

Route::get('/pengaturan/sifat-naskah', 'Pengaturan\SifatNaskahController@index');
Route::post('/pengaturan/sifat-naskah/tambah', 'Pengaturan\SifatNaskahController@tambah');
Route::post('/pengaturan/sifat-naskah/edit', 'Pengaturan\SifatNaskahController@edit');
Route::delete('/pengaturan/sifat-naskah/{id}/delete', 'Pengaturan\SifatNaskahController@delete');

Route::get('/pengaturan/tingkat-perkembangan', 'Pengaturan\PerkembanganController@index');
Route::post('/pengaturan/tingkat-perkembangan/tambah', 'Pengaturan\PerkembanganController@tambah');
Route::post('/pengaturan/tingkat-perkembangan/edit', 'Pengaturan\PerkembanganController@edit');
Route::delete('/pengaturan/tingkat-perkembangan/{id}/delete', 'Pengaturan\PerkembanganController@delete');

Route::get('/pengaturan/tingkat-urgensi', 'Pengaturan\UrgensiController@index');
Route::post('/pengaturan/tingkat-urgensi/tambah', 'Pengaturan\UrgensiController@tambah');
Route::post('/pengaturan/tingkat-urgensi/edit', 'Pengaturan\UrgensiController@edit');
Route::delete('/pengaturan/tingkat-urgensi/{id}/delete', 'Pengaturan\UrgensiController@delete');

Route::get('/pengaturan/ekstensi-file', 'Pengaturan\EkstensiController@index');
Route::post('/pengaturan/ekstensi-file/tambah', 'Pengaturan\EkstensiController@tambah');
Route::post('/pengaturan/ekstensi-file/edit', 'Pengaturan\EkstensiController@edit');
Route::delete('/pengaturan/ekstensi-file/{id}/delete', 'Pengaturan\EkstensiController@delete');

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
Route::post('/pengaturan/halaman-depan/edit', 'Pengaturan\HalamanDepanController@edit');

Route::get('/pengaturan/instansi', 'Pengaturan\InstansiController@index');
Route::get('/pengaturan/instansi/tambah', 'Pengaturan\InstansiController@tambah');
Route::post('/pengaturan/instansi/simpan', 'Pengaturan\InstansiController@simpan');
Route::get('/pengaturan/instansi/{id}/edit', 'Pengaturan\InstansiController@edit');
Route::post('/pengaturan/instansi/{id}/update', 'Pengaturan\InstansiController@update');
Route::delete('/pengaturan/instansi/{id}/delete', 'Pengaturan\InstansiController@delete');

Route::get('/pengaturan/template-dokumen', 'Pengaturan\TemplateDokController@index');
Route::post('/pengaturan/template-dokumen/tambah', 'Pengaturan\TemplateDokController@tambah');
Route::post('/pengaturan/template-dokumen/edit', 'Pengaturan\TemplateDokController@edit');
Route::get('/pengaturan/template-dokumen/{id}/download', 'Pengaturan\TemplateDokController@download');
Route::delete('/pengaturan/template-dokumen/{id}/delete', 'Pengaturan\TemplateDokController@delete');

Route::middleware(['user'])->group(function(){
	Route::post('/logout', 'Login\LoginController@logout');
	
	Route::get('/dashboard', function() {
		return view('dashboard');
	});

	/* ------------------------- Bagian Pengaturan ----------------------------------- */

	Route::get('/pengaturan/bahasa', 'Pengaturan\BahasaController@index');
	Route::post('/pengaturan/bahasa/tambah', 'Pengaturan\BahasaController@tambah');
	Route::post('/pengaturan/bahasa/edit', 'Pengaturan\BahasaController@edit');
	Route::delete('/pengaturan/bahasa/{id}/delete', 'Pengaturan\BahasaController@delete');

	Route::get('/pengaturan/jenis-naskah', 'Pengaturan\JenisNaskahController@index');
	Route::post('/pengaturan/jenis-naskah/tambah', 'Pengaturan\JenisNaskahController@tambah');
	Route::post('/pengaturan/jenis-naskah/edit', 'Pengaturan\JenisNaskahController@edit');
	Route::delete('/pengaturan/jenis-naskah/{id}/delete', 'Pengaturan\JenisNaskahController@delete');

	Route::get('/pengaturan/media-arsip', 'Pengaturan\MediaArsipController@index');
	Route::post('/pengaturan/media-arsip/tambah', 'Pengaturan\MediaArsipController@tambah');
	Route::post('/pengaturan/media-arsip/edit', 'Pengaturan\MediaArsipController@edit');
	Route::delete('/pengaturan/media-arsip/{id}/delete', 'Pengaturan\MediaArsipController@delete');

	Route::get('/pengaturan/sifat-naskah', 'Pengaturan\SifatNaskahController@index');
	Route::post('/pengaturan/sifat-naskah/tambah', 'Pengaturan\SifatNaskahController@tambah');
	Route::post('/pengaturan/sifat-naskah/edit', 'Pengaturan\SifatNaskahController@edit');
	Route::delete('/pengaturan/sifat-naskah/{id}/delete', 'Pengaturan\SifatNaskahController@delete');

	Route::get('/pengaturan/tingkat-perkembangan', 'Pengaturan\PerkembanganController@index');
	Route::post('/pengaturan/tingkat-perkembangan/tambah', 'Pengaturan\PerkembanganController@tambah');
	Route::post('/pengaturan/tingkat-perkembangan/edit', 'Pengaturan\PerkembanganController@edit');
	Route::delete('/pengaturan/tingkat-perkembangan/{id}/delete', 'Pengaturan\PerkembanganController@delete');

	Route::get('/pengaturan/tingkat-urgensi', 'Pengaturan\UrgensiController@index');
	Route::post('/pengaturan/tingkat-urgensi/tambah', 'Pengaturan\UrgensiController@tambah');
	Route::post('/pengaturan/tingkat-urgensi/edit', 'Pengaturan\UrgensiController@edit');
	Route::delete('/pengaturan/tingkat-urgensi/{id}/delete', 'Pengaturan\UrgensiController@delete');

	Route::get('/pengaturan/ekstensi-file', 'Pengaturan\EkstensiController@index');
	Route::post('/pengaturan/ekstensi-file/tambah', 'Pengaturan\EkstensiController@tambah');
	Route::post('/pengaturan/ekstensi-file/edit', 'Pengaturan\EkstensiController@edit');
	Route::delete('/pengaturan/ekstensi-file/{id}/delete', 'Pengaturan\EkstensiController@delete');

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
	Route::post('/pengaturan/halaman-depan/edit', 'Pengaturan\HalamanDepanController@edit');

	Route::get('/pengaturan/instansi', 'Pengaturan\InstansiController@index');
	Route::get('/pengaturan/instansi/tambah', 'Pengaturan\InstansiController@tambah');
	Route::post('/pengaturan/instansi/simpan', 'Pengaturan\InstansiController@simpan');
	Route::get('/pengaturan/instansi/{id}/edit', 'Pengaturan\InstansiController@edit');
	Route::post('/pengaturan/instansi/{id}/update', 'Pengaturan\InstansiController@update');
	Route::delete('/pengaturan/instansi/{id}/delete', 'Pengaturan\InstansiController@delete');

	Route::get('/pengaturan/template-dokumen', 'Pengaturan\TemplateDokController@index');
	Route::post('/pengaturan/template-dokumen/tambah', 'Pengaturan\TemplateDokController@tambah');
	Route::post('/pengaturan/template-dokumen/edit', 'Pengaturan\TemplateDokController@edit');
	Route::get('/pengaturan/template-dokumen/{id}/download', 'Pengaturan\TemplateDokController@download');
	Route::delete('/pengaturan/template-dokumen/{id}/delete', 'Pengaturan\TemplateDokController@delete');
});

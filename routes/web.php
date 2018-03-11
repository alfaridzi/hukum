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

Route::middleware(['user'])->group(function(){
	Route::post('/logout', 'Login\LoginController@logout');
	
	Route::get('/dashboard', function() {
		return view('dashboard');
	});

	Route::get('unitkerja','unitKerjaController@unitKerja');
	Route::post('unitkerja/tambah','unitKerjaController@tambahUnitKerja');
	Route::get('unitkerja/delete/{id}', 'unitKerjaController@deleteData');
	Route::post('unitkerja/update/{id}','unitKerjaController@updateUnitKerja');

	Route::get('klasifikasi','klasifikasiController@klasifikasi');
	Route::post('klasifikasi/tambah','klasifikasiController@tambahKlasifikasi');
	Route::get('klasifikasi/delete/{id}', 'klasifikasiController@deleteData');
	Route::post('klasifikasi/update/{id}','klasifikasiController@updateKlasifikasi');


	//pengguna
	Route::get('/pengguna', 'penggunaController@index');
	Route::post('/pengguna/tambah', 'penggunaController@tambah');
	Route::post('/pengguna/edit', 'penggunaController@edit');
	Route::delete('/pengguna/{id}/delete', 'penggunaController@delete');


	Route::get('/registrasi-naskah', 'Naskah\RegistrasiNaskahController@index');
	Route::post('/registrasi-naskah/simpan', 'Naskah\RegistrasiNaskahController@simpan');
	Route::get('/registrasi-naskah/template-dokumen', 'Pengaturan\TemplateDokController@regdownload');
	Route::get('/registrasi-naskah/template-dokumen/{id}/download', 'Pengaturan\TemplateDokController@download');

	Route::get('/naskah-masuk', 'Naskah\NaskahMasukController@index');
	Route::get('/naskah-masuk/detail/{id}', 'Naskah\NaskahMasukController@detail');
	Route::get('/naskah-masuk/detail/{id}/ubah-metadata', 'Naskah\NaskahMasukController@ubahMetadata');
	Route::post('/naskah-masuk/detail/{id}/ubah-metadata/update', 'Naskah\NaskahMasukController@updateMetadata');

	Route::get('/log/registrasi-naskah-masuk', 'Log\RegistrasiNaskahMasuk\LogController@rgNaskahMasuk');
	Route::get('/log/registrasi-naskah-masuk/detail/{id}', 'Log\RegistrasiNaskahMasuk\LogController@detailRgNaskahMasuk');
	Route::get('/log/registrasi-naskah-masuk/detail/{id}/ubah-metadata', 'Log\RegistrasiNaskahMasuk\LogController@ubahMetaRgNaskahMasuk');
	Route::post('/log/registrasi-naskah-masuk/detail/{id}/ubah-metadata/update', 'Log\RegistrasiNaskahMasuk\LogController@updateMetaRgNaskahMasuk');
	Route::get('/log/registrasi-naskah-masuk/download/{namaFile}', 'Log\RegistrasiNaskahMasuk\LogController@downloadRgNaskahMasuk');

	Route::get('/log/memo', 'Log\Memo\LogController@memo');
	Route::get('/log/memo/detail/{id}', 'Log\Memo\LogController@detailMemo');
	Route::get('/log/memo/detail/{id}/ubah-metadata', 'Log\Memo\LogController@ubahMetaMemo');
	Route::post('/log/memo/detail/{id}/ubah-metadata/update', 'Log\Memo\LogController@updateMetaMemo');
	Route::get('/log/memo/download/{namaFile}', 'Log\Memo\LogController@downloadMemo');

	Route::get('/log/nota-dinas', 'Log\NotaDinas\LogController@notaDinas');
	Route::get('/log/nota-dinas/detail/{id}', 'Log\NotaDinas\LogController@detailNotaDinas');
	Route::get('/log/nota-dinas/detail/{id}/ubah-metadata', 'Log\NotaDinas\LogController@ubahMetaNotaDinas');
	Route::post('/log/nota-dinas/detail/{id}/ubah-metadata/update', 'Log\NotaDinas\LogController@updateMetaNotaDinas');
	Route::get('/log/nota-dinas/download/{namaFile}', 'Log\NotaDinas\LogController@downloadNotaDinas');

	Route::get('/log/naskah-keluar', 'Log\NaskahKeluar\LogController@naskahKeluar');
	Route::get('/log/naskah-keluar/detail/{id}', 'Log\NaskahKeluar\LogController@detailNaskahKeluar');
	Route::get('/log/naskah-keluar/detail/{id}/ubah-metadata', 'Log\NaskahKeluar\LogController@ubahMetaNaskahKeluar');
	Route::post('/log/naskah-keluar/detail/{id}/ubah-metadata/update', 'Log\NaskahKeluar\LogController@updateMetaNaskahKeluar');
	Route::get('/log/naskah-keluar/download/{namaFile}', 'Log\NaskahKeluar\LogController@downloadNaskahKeluar');

	Route::get('/log/naskah-tanpa-tindak-lanjut', 'Log\NaskahTanpaTindakLanjut\LogController@index');
	Route::get('/log/naskah-tanpa-tindak-lanjut/detail/{id}', 'Log\NaskahTanpaTindakLanjut\LogController@detail');
	Route::get('/log/naskah-tanpa-tindak-lanjut/detail/{id}/ubah-metadata', 'Log\NaskahTanpaTindakLanjut\LogController@ubahMetadata');
	Route::post('/log/naskah-tanpa-tindak-lanjut/detail/{id}/ubah-metadata/update', 'Log\NaskahTanpaTindakLanjut\LogController@updateMetadata');
	Route::get('/log/naskah-tanpa-tindak-lanjut/download/{namaFile}', 'Log\NaskahTanpaTindakLanjut\LogController@download');

	/* ------------------------- Bagian Pengaturan ----------------------------------- */
	Route::prefix('pengaturan')->group(function(){
		Route::get('bahasa', 'Pengaturan\BahasaController@index');
		Route::post('bahasa/tambah', 'Pengaturan\BahasaController@tambah');
		Route::post('bahasa/edit', 'Pengaturan\BahasaController@edit');
		Route::delete('bahasa/{id}/delete', 'Pengaturan\BahasaController@delete');

		Route::get('jenis-naskah', 'Pengaturan\JenisNaskahController@index');
		Route::post('jenis-naskah/tambah', 'Pengaturan\JenisNaskahController@tambah');
		Route::post('jenis-naskah/edit', 'Pengaturan\JenisNaskahController@edit');
		Route::delete('jenis-naskah/{id}/delete', 'Pengaturan\JenisNaskahController@delete');

		Route::get('media-arsip', 'Pengaturan\MediaArsipController@index');
		Route::post('media-arsip/tambah', 'Pengaturan\MediaArsipController@tambah');
		Route::post('media-arsip/edit', 'Pengaturan\MediaArsipController@edit');
		Route::delete('media-arsip/{id}/delete', 'Pengaturan\MediaArsipController@delete');

		Route::get('sifat-naskah', 'Pengaturan\SifatNaskahController@index');
		Route::post('sifat-naskah/tambah', 'Pengaturan\SifatNaskahController@tambah');
		Route::post('sifat-naskah/edit', 'Pengaturan\SifatNaskahController@edit');
		Route::delete('sifat-naskah/{id}/delete', 'Pengaturan\SifatNaskahController@delete');

		Route::get('tingkat-perkembangan', 'Pengaturan\PerkembanganController@index');
		Route::post('tingkat-perkembangan/tambah', 'Pengaturan\PerkembanganController@tambah');
		Route::post('tingkat-perkembangan/edit', 'Pengaturan\PerkembanganController@edit');
		Route::delete('tingkat-perkembangan/{id}/delete', 'Pengaturan\PerkembanganController@delete');

		Route::get('tingkat-urgensi', 'Pengaturan\UrgensiController@index');
		Route::post('tingkat-urgensi/tambah', 'Pengaturan\UrgensiController@tambah');
		Route::post('tingkat-urgensi/edit', 'Pengaturan\UrgensiController@edit');
		Route::delete('tingkat-urgensi/{id}/delete', 'Pengaturan\UrgensiController@delete');

		Route::get('ekstensi-file', 'Pengaturan\EkstensiController@index');
		Route::post('ekstensi-file/tambah', 'Pengaturan\EkstensiController@tambah');
		Route::post('ekstensi-file/edit', 'Pengaturan\EkstensiController@edit');
		Route::delete('ekstensi-file/{id}/delete', 'Pengaturan\EkstensiController@delete');

		Route::get('text-tombol', 'Pengaturan\TextTombolController@index');
		Route::post('text-tombol/edit', 'Pengaturan\TextTombolController@edit');

		Route::get('satuan-unit', 'Pengaturan\SatuanUnitController@index');
		Route::post('satuan-unit/tambah', 'Pengaturan\SatuanUnitController@tambah');
		Route::post('satuan-unit/edit', 'Pengaturan\SatuanUnitController@edit');
		Route::delete('satuan-unit/delete/{id}', 'Pengaturan\SatuanUnitController@delete');

		Route::get('grup-jabatan', 'Pengaturan\GrupJabatanController@index');
		Route::post('grup-jabatan/tambah', 'Pengaturan\GrupJabatanController@tambah');
		Route::post('grup-jabatan/edit', 'Pengaturan\GrupJabatanController@edit');
		Route::delete('grup-jabatan/delete/{id}', 'Pengaturan\GrupJabatanController@delete');

		Route::get('isi-disposisi', 'Pengaturan\IsiDisposisiController@index');
		Route::post('isi-disposisi/tambah', 'Pengaturan\IsiDisposisiController@tambah');
		Route::post('isi-disposisi/edit', 'Pengaturan\IsiDisposisiController@edit');
		Route::delete('isi-disposisi/delete/{id}', 'Pengaturan\IsiDisposisiController@delete');

		Route::get('halaman-depan', 'Pengaturan\HalamanDepanController@index');
		Route::post('halaman-depan/edit', 'Pengaturan\HalamanDepanController@edit');

		Route::get('instansi', 'Pengaturan\InstansiController@index');
		Route::get('instansi/tambah', 'Pengaturan\InstansiController@tambah');
		Route::post('instansi/simpan', 'Pengaturan\InstansiController@simpan');
		Route::get('instansi/{id}/edit', 'Pengaturan\InstansiController@edit');
		Route::post('instansi/{id}/update', 'Pengaturan\InstansiController@update');
		Route::delete('instansi/{id}/delete', 'Pengaturan\InstansiController@delete');

		Route::get('template-dokumen', 'Pengaturan\TemplateDokController@index');
		Route::post('template-dokumen/tambah', 'Pengaturan\TemplateDokController@tambah');
		Route::post('template-dokumen/edit', 'Pengaturan\TemplateDokController@edit');
		Route::get('template-dokumen/{id}/download', 'Pengaturan\TemplateDokController@download');
		Route::delete('template-dokumen/{id}/delete', 'Pengaturan\TemplateDokController@delete');
	});
});

<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\IsiDisposisi;
use App\Model\Pengaturan\GrupJabatan;

class IsiDisposisiController extends Controller
{
    public function index()
    {
    	$isiDisposisi = IsiDisposisi::all()->load('grup_jabatan');
    	$grupJabatan = GrupJabatan::all();
    	$no = 1;
    	return view('pengaturan.isi_disposisi', compact('isiDisposisi', 'grupJabatan', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$message = [
    		'isi_disposisi.required' => 'Field Isi Disposisi dibutuhkan',
    		'isi_disposisi.string' => 'Field Isi Disposisi harus berupa string',
    		'isi_disposisi.max' => 'Field Isi Disposisi tidak boleh lebih dari 255 karakter',
    		'grup_jabatan.required' => 'Field Grup Jabatan dibutuhkan',
    		'grup_jabatan.integer' => 'Field Grup Jabatan harus berupa integer',
    		'grup_jabatan.max' => 'Field Isi Disposisi tidak boleh lebih dari 10 karakter',
    	];

    	$validator = Validator::make($input, [
    		'isi_disposisi' => 'required|string|max:255',
    		'grup_jabatan' => 'required|integer|max:10'
    	], $message);

    	if ($validator->fails()) {
    		return redirect('pengaturan/isi-disposisi')
    					 ->withErrors($validator);
    	}

    	IsiDisposisi::create(['isi_disposisi' => $input['isi_disposisi'], 'id_grup' => $input['grup_jabatan']]);
    	return redirect()->back()->with('success', 'Berhasil menambahkan data baru');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();

    	$message = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer'  => 'Terjadi suatu kesalahan',
    		'isi_disposisi.required' => 'Field Isi Disposisi dibutuhkan',
    		'isi_disposisi.string' => 'Field Isi Disposisi harus berupa string',
    		'isi_disposisi.max' => 'Field Isi Disposisi tidak boleh lebih dari 255 karakter',
    		'grup_jabatan.required' => 'Field Grup Jabatan dibutuhkan',
    		'grup_jabatan.integer' => 'Field Grup Jabatan harus berupa integer',
    		'grup_jabatan.max' => 'Field Isi Disposisi tidak boleh lebih dari 10 karakter',
    	];

    	$validator = Validator::make($input, [
    		'id' => 'required|integer',
    		'isi_disposisi' => 'required|string|max:255',
    		'grup_jabatan' => 'required|integer|max:10'
    	], $message);

    	if ($validator->fails()) {
    		return redirect('pengaturan/isi-disposisi')
    					 ->withErrors($validator);
    	}

    	$isiDisposisi = IsiDisposisi::findOrFail($input['id']);
    	$isiDisposisi->update(['isi_disposisi' => $input['isi_disposisi'], 'id_grup' => $input['grup_jabatan']]);

    	return redirect()->back()->with('success', 'Berhasil update data');

    }

    public function delete($id)
    {
    	if (is_null($id)) {
    		return redirect()->back();
    	}

    	$isiDisposisi = IsiDisposisi::find($id);
    	$isiDisposisi->delete();

    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

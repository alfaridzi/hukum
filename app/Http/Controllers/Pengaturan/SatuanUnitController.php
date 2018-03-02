<?php

namespace App\Http\Controllers\Pengaturan;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Pengaturan\SatuanUnit;

class SatuanUnitController extends Controller
{
    public function index()
    {
    	$satuanUnit = SatuanUnit::all();
    	$no = 1;
    	return view('pengaturan.satuan_unit', compact('satuanUnit', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$message = [
    		'nama_satuan.required' => 'Field Satuan Unit dibutuhkan',
    		'nama_satuan.string' => 'Field Satuan Unit harus berupa string',
    	];

    	$validator = Validator::make($input, [
    		'nama_satuan' => 'required|string'
    	], $message);

    	if ($validator->fails()) {
    		return redirect('pengaturan/satuan-unit')
    					 ->withErrors($validator);
    	}

    	SatuanUnit::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data baru!');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();

    	$message = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan',
    		'nama_satuan.required' => 'Field text dibutuhkan',
    		'nama_satuan.string' => 'Field Satuan Unit harus berupa string',
    	];

    	$validator = Validator::make($input, [
    		'id' => 'required|integer',
    		'nama_satuan' => 'required|string'
    	], $message);

    	if ($validator->fails()) {
    		return redirect('pengaturan/satuan-unit')
    					 ->withErrors($validator);
    	}

    	$satuanUnit = SatuanUnit::findOrFail($input['id']);
    	
    	$satuanUnit->update(['nama_satuan' => $input['nama_satuan']]);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
        if (is_null($id)) {
            return redirect()->back();
        }

        $satuanUnit = SatuanUnit::findOrFail($id);
        $satuanUnit->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

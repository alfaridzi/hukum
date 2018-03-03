<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\SifatNaskah;
use Carbon\Carbon;

class SifatNaskahController extends Controller
{
    public function index()
    {
    	$sifatNaskah = SifatNaskah::all();
    	$no = 1;
    	return view('pengaturan.sifat_naskah', compact('sifatNaskah', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
    		'sifat_naskah' => 'required|string|max:40',
    	]);

    	if ($validator->fails()) {
    		return redirect('pengaturan/sifat-naskah')
    					->withErrors($validator);
    	}

    	SifatNaskah::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();
        $sifatNaskah = SifatNaskah::findOrFail($input['id']);

    	$messages = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan'
    	];

    	$validator = Validator::make($input, [
    		'id'	 => 'required|integer',
    		'sifat_naskah' => 'required|string',
    	], $messages);

    	if ($validator->fails()) {
    		return redirect('pengaturan/sifat-naskah')
    					->withErrors($validator);
    	}

        $input['updated_at'] = Carbon::now();
        
    	$sifatNaskah->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	$sifatNaskah = SifatNaskah::findOrFail($id)->delete();

    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

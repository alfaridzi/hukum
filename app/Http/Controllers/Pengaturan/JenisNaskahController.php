<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\JenisNaskah;
use Carbon\Carbon;

class JenisNaskahController extends Controller
{
    public function index()
    {
    	$jenisNaskah = JenisNaskah::all();
    	$no = 1;
    	return view('pengaturan.jenis_naskah', compact('jenisNaskah', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
    		'jenis_naskah' => 'required|string|max:40',
    	]);

    	if ($validator->fails()) {
    		return redirect('pengaturan/jenis-naskah')
    					->withErrors($validator);
    	}

    	JenisNaskah::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();
        $jenisNaskah = JenisNaskah::findOrFail($input['id']);
    	$messages = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan'
    	];

    	$validator = Validator::make($input, [
    		'id'	 => 'required|integer',
    		'jenis_naskah' => 'required|string|max:40',
    	], $messages);

    	if ($validator->fails()) {
    		return redirect('pengaturan/jenis-naskah')
    					->withErrors($validator);
    	}
        
        $input['updated_at'] = Carbon::now();

    	$jenisNaskah->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	$jenisNaskah = JenisNaskah::findOrFail($id)->delete();

    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

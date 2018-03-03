<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\Ekstensi;
use Carbon\Carbon;

class EkstensiController extends Controller
{
    public function index()
    {
    	$ekstensi = Ekstensi::all();
    	$no = 1;
    	return view('pengaturan.ekstensi_file', compact('ekstensi', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
    		'jenis_ekstensi' => 'required|string|max:15',
    	]);

    	if ($validator->fails()) {
    		return redirect('pengaturan/ekstensi-file')
    					->withErrors($validator);
    	}

    	Ekstensi::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();
    	$ekstensi = Ekstensi::findOrFail($input['id']);

    	$messages = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan'
    	];

    	$validator = Validator::make($input, [
    		'id'	 => 'required|integer',
    		'jenis_ekstensi' => 'required|string|max:15',
    	], $messages);

    	if ($validator->fails()) {
    		return redirect('pengaturan/ekstensi-file')
    					->withErrors($validator);
    	}
    	$input['updated_at'] = Carbon::now();

    	$ekstensi->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	$ekstensi = Ekstensi::findOrFail($id)->delete();

    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

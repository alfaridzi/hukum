<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\Bahasa;
use Carbon\Carbon;

class BahasaController extends Controller
{
    public function index()
    {
    	$bahasa = Bahasa::all();
    	$no = 1;
    	return view('pengaturan.bahasa', compact('bahasa', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
    		'bahasa' => 'required|string|max:40',
    	]);

    	if ($validator->fails()) {
    		return redirect('pengaturan/bahasa')
    					->withErrors($validator);
    	}

    	Bahasa::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();

    	$messages = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan'
    	];

    	$validator = Validator::make($input, [
    		'id'	 => 'required|integer',
    		'bahasa' => 'required|string|max:40',
    	], $messages);

    	if ($validator->fails()) {
    		return redirect('pengaturan/bahasa')
    					->withErrors($validator);
    	}
        $input['updated_at'] = Carbon::now();
    	$bahasa = Bahasa::findOrFail($input['id'])->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	$bahasa = Bahasa::findOrFail($id)->delete();

    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

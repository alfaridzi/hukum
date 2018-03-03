<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\Perkembangan;
use Carbon\Carbon;

class PerkembanganController extends Controller
{
    public function index()
    {
    	$perkembangan = Perkembangan::all();
    	$no = 1;
    	return view('pengaturan.tingkat_perkembangan', compact('perkembangan', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
    		'tingkat_perkembangan' => 'required|string|max:40',
    	]);

    	if ($validator->fails()) {
    		return redirect('pengaturan/tingkat-perkembangan')
    					->withErrors($validator);
    	}

    	$input['tingkat'] = $input['tingkat_perkembangan'];

    	Perkembangan::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();

        $perkembangan = Perkembangan::findOrFail($input['id']);

    	$messages = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan'
    	];

    	$validator = Validator::make($input, [
    		'id'	 => 'required|integer',
    		'tingkat_perkembangan' => 'required|string|max:40',
    	], $messages);

    	if ($validator->fails()) {
    		return redirect('pengaturan/tingkat-perkembangan')
    					->withErrors($validator);
    	}

    	$input['tingkat'] = $input['tingkat_perkembangan'];
        $input['updated_at'] = Carbon::now();

    	$perkembangan->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	$perkembangan = Perkembangan::findOrFail($id)->delete();

    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\Urgensi;
use Carbon\Carbon;

class UrgensiController extends Controller
{
    public function index()
    {
    	$urgensi = Urgensi::all();
    	$no = 1;
    	return view('pengaturan.tingkat_urgensi', compact('urgensi', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
    		'tingkat_urgensi' => 'required|string|max:40',
    	]);

    	if ($validator->fails()) {
    		return redirect('pengaturan/tingkat-urgensi')
    					->withErrors($validator);
    	}

    	$input['tingkat'] = $input['tingkat_urgensi'];

    	Urgensi::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();
        $urgensi = Urgensi::findOrFail($input['id']);

    	$messages = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan'
    	];

    	$validator = Validator::make($input, [
    		'id'	 => 'required|integer',
    		'tingkat_urgensi' => 'required|string|max:40',
    	], $messages);

    	if ($validator->fails()) {
    		return redirect('pengaturan/tingkat-urgensi')
    					->withErrors($validator);
    	}

    	$input['tingkat'] = $input['tingkat_urgensi'];
        $input['updated_at'] = Carbon::now();
    	$urgensi->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	$urgensi = Urgensi::findOrFail($id)->delete();

    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

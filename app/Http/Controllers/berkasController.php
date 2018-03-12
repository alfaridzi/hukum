<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\berkas;
use Auth;
use App\klasifikasi;


class berkasController extends Controller
{
    public function index() {
    	$user = Auth::user()->jabatan;
    	$klasifikasi = klasifikasi::where('parent_id', '=', 0)->get();
    	$berkas = berkas::where('id_unitkerja', Auth::user()->id_jabatan)->get();
    	if($berkas->count() > 0) {
    		$nomor_berkas = $berkas->last()->nomor_berkas + 1;
    	} else {
    		$nomor_berkas = 1;
    	}

    	$no = 1;
    	return view('berkas',compact('user','berkas','no','klasifikasi','nomor_berkas'));
    }


    public function tambah(Request $request)
    {
    	$input = $request->all();

    	//$validator = Validator::make($input, [
    	//	'bahasa' => 'required|string|max:40',
    	//]);

    	//if ($validator->fails()) {
    	//	return redirect('pengaturan/bahasa')
    	//					->withErrors($validator);
    	//}


    	berkas::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan Berkas');
    }



    public function edit(Request $request)
    {
    	$input = $request->all();

    	//$messages = [
    	//	'id.required' => 'Terjadi suatu kesalahan',
    	//	'id.integer' => 'Terjadi suatu kesalahan'
    	//];

    	//$validator = Validator::make($input, [
    	//	'id'	 => 'required|integer',
    	//	'bahasa' => 'required|string|max:40',
    	//], $messages);
//
  //  	if ($validator->fails()) {
    //		return redirect('pengaturan/bahasa')
    //					->withErrors($validator);
    //	}

    	$berkas = berkas::where('id_berkas', $input['id_berkas'])->first()->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }


}
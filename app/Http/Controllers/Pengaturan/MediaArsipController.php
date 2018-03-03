<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\MediaArsip;
use Carbon\Carbon;

class MediaArsipController extends Controller
{
    public function index()
    {
    	$mediaArsip = MediaArsip::all();
    	$no = 1;
    	return view('pengaturan.media_arsip', compact('mediaArsip', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
    		'media_arsip' => 'required|string|max:40',
    	]);

    	if ($validator->fails()) {
    		return redirect('pengaturan/media-arsip')
    					->withErrors($validator);
    	}

    	MediaArsip::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();

        $mediaArsip = MediaArsip::findOrFail($input['id']);

    	$messages = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan'
    	];

    	$validator = Validator::make($input, [
    		'id'	 => 'required|integer',
    		'media_arsip' => 'required|string|max:40',
    	], $messages);

    	if ($validator->fails()) {
    		return redirect('pengaturan/media-arsip')
    					->withErrors($validator);
    	}
        $input['updated_at'] = Carbon::now();
        
    	$mediaArsip->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	$mediaArsip = MediaArsip::findOrFail($id)->delete();

    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

<?php

namespace App\Http\Controllers\Pengaturan;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\TextTombol;
use Carbon\Carbon;

class TextTombolController extends Controller
{
    public function index()
    {
    	$textTombol = TextTombol::all();
    	$no = 1;
    	return view('pengaturan.text_tombol', compact('textTombol', 'no'));
    }

    public function edit(Request $request)
    {
    	$input = $request->all();
        $textTombol = TextTombol::findOrFail($input['id']);

    	$message = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan',
    	];

    	$validator = Validator::make($input, [
    		'id' => 'required|integer',
    		'text' => 'required|string'
    	], $message);

    	if ($validator->fails()) {
    		return redirect('pengaturan/text-tombol')
    					 ->withErrors($validator);
    	}

    	$textTombol->update([
    		'text' => $input['text'],
            'updated_at' => Carbon::now(),
    	]);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }
}

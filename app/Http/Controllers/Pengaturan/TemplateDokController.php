<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use File;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\TemplateDok;
use Carbon\Carbon;

class TemplateDokController extends Controller
{
    public function index()
    {
    	$templateDok = TemplateDok::all();
    	$no = 1;
    	return view('pengaturan.template_dokumen', compact('templateDok', 'no'));
    }

    public function download($id)
    {
    	$templateDok = TemplateDok::findOrFail($id);
    	if (!File::exists('assets/FilesUploaded/TemplateDokumen/'.$templateDok->file_template)) {
    		return redirect()->back()->withErrors('Tidak dapat menemukan file');
    	}

    	return response()->download('assets/FilesUploaded/TemplateDokumen/'.$templateDok->file_template);
    }

    public function regdownload()
    {
        $templateDok = TemplateDok::all();
        $no = 1;
        return view('registrasi_naskah.template_dokumen', compact('templateDok', 'no'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
    		'nama_template' => 'required|string',
    		'file_template' => 'required|file'
    	]);

    	if ($validator->fails()) {
    		return redirect('pengaturan/template-dokumen')
    					->withErrors($validator);
    	}

    	$fileTemplate = $request->file('file_template');
    	$namaFile = substr(str_random(5).'-'.pathinfo($fileTemplate->getClientOriginalName(), PATHINFO_FILENAME), 0, 30).'.'.$fileTemplate->getClientOriginalExtension();
    	$input['file_template'] = $namaFile;

    	$fileTemplate->move('assets/FilesUploaded/TemplateDokumen/', $namaFile);

    	TemplateDok::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();
    	$templateDok = TemplateDok::findOrFail($input['id']);

    	$messages = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan'
    	];

    	$validator = Validator::make($input, [
    		'id'	 => 'required|integer',
    		'nama_template' => 'required|string',
    		'file_template' => 'file'
    	], $messages);

    	if ($validator->fails()) {
    		return redirect('pengaturan/template-dokumen')
    					->withErrors($validator);
    	}

    	if (!is_null($request->file('file_template'))) {
    		$fileTemplate = $request->file('file_template');
    		if (File::exists('assets/FilesUploaded/TemplateDokumen/'.$templateDok->file_template)) {
    			File::delete('assets/FilesUploaded/TemplateDokumen/'.$templateDok->file_template);
    		}
	    	$namaFile = substr(str_random(5).'-'.pathinfo($fileTemplate->getClientOriginalName(), PATHINFO_FILENAME), 0, 30).'.'.$fileTemplate->getClientOriginalExtension();

	    	$fileTemplate->move('assets/FilesUploaded/TemplateDokumen/', $namaFile);

	    	$input['file_template'] = $namaFile;
    	}
    	$input['updated_at'] = Carbon::now();

    	$templateDok->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	$templateDok = TemplateDok::findOrFail($id);

    	if (File::exists('assets/FilesUploaded/TemplateDokumen/'.$templateDok->file_template)) {
    		File::delete('assets/FilesUploaded/TemplateDokumen/'.$templateDok->file_template);
    	}

    	$templateDok->delete();
    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

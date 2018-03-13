<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Files;
use File;

class DownloadController extends Controller
{
    public function __invoke($id, $namaFile)
    {
        $getGroup = Files::where('nama_file', $namaFile)->first();
    	$file = Files::where('nama_file', $namaFile)->with(['penerima' => function($q) use($id, $getGroup){
            $q->where('id_naskah', $id)->where('id_group', $getGroup->id_group)->groupBy('id_group')->with('naskah');
        }])->first();

    	if (!File::exists('assets/FilesUploaded/'.$file->penerima->naskah->file_dir.'/'.$file->nama_file)) {
    		return redirect()->back()->withErrors('Tidak dapat menemukan file');
    	}

    	return response()->download('assets/FilesUploaded/'.$file->penerima->naskah->file_dir.'/'.$file->nama_file);
    }
}

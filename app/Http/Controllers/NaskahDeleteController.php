<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Naskah\Naskah;
use App\Model\Files;
use App\Model\Penerima;
use App\Model\Disposisi;

use File;
use Auth;

class NaskahDeleteController extends Controller
{
    public function deleteNaskah($id)
    {
    	$naskah = Naskah::findOrFail($id);
        $penerima = Penerima::where('id_naskah', $id)->get();

        $file = Files::where('id_naskah', $id)->get();

        $disposisi = Disposisi::where('id_naskah', $id)->get();

        foreach ($file as $key => $data) {
            if (File::exists('assets/FilesUploaded/'.$naskah->file_dir.'/'.$data->nama_file)) {
                File::delete('assets/FilesUploaded/'.$naskah->file_dir.'/'.$data->nama_file);
            }
            $data->delete();
        }

        foreach ($penerima as $data) {
            $data->delete();
        }

        foreach ($disposisi as $data) {
            $data->delete();
        }

        $naskah->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus naskah');
    }

    public function deletePenerima($id, $idGroup)
    {
        $naskah = Naskah::find($id);

        $penerima = Penerima::where('id_naskah', $id)->where('id_group', $idGroup)->get();

        $file = Files::where('id_naskah', $id)->where('id_group', $idGroup)->get();

        $disposisi = Disposisi::where('id_naskah', $id)->where('id_group', $idGroup)->get();

        foreach ($file as $key => $data) {
            if (File::exists('assets/FilesUploaded/'.$naskah->file_dir.'/'.$data->nama_file)) {
                File::delete('assets/FilesUploaded/'.$naskah->file_dir.'/'.$data->nama_file);
            }
            $data->delete();
        }

        foreach ($penerima as $data) {
            $data->delete();
        }

        foreach ($disposisi as $data) {
            $data->delete();
        }
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

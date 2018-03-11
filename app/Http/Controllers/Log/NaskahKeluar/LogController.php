<?php

namespace App\Http\Controllers\Log\NaskahKeluar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Naskah\Naskah;
use App\Model\Pengaturan\JenisNaskah;
use App\Model\Pengaturan\Perkembangan;
use App\Model\Pengaturan\Urgensi;
use App\Model\Pengaturan\SifatNaskah;
use App\Model\Pengaturan\MediaArsip;
use App\Model\Pengaturan\Bahasa;
use App\Model\Pengaturan\SatuanUnit;
use App\Model\Files;

use App\Http\Requests\NaskahMasuk\UbahMetadataRequest;

use Auth;
use File;

class LogController extends Controller
{
    public function naskahKeluar()
    {
    	$user = Auth::user();
    	$naskah = Naskah::where('tipe_registrasi', '4')->whereHas('user', function($q) use($user){
    		$q->where('id_jabatan', $user->id_jabatan);
    	})->with(['penerima' => function($q){
    		$q->where('sebagai', 'to_keluar')->groupBy('id_group');
    	}])->with('urgensi')->orderBy('id_naskah', 'asc')->get();
    	$no = 1;
    	return view('log.naskah_keluar.index', compact('naskah', 'no'));
    }

    public function detailNaskahKeluar($id)
    {
    	$getGroup = Naskah::findOrFail($id)->id_group;
    	$user = Auth::user();
    	$metadataNaskah = Naskah::where('id_naskah', $id)->with('urgensi', 'jenisNaskah', 'tingkatPerkembangan', 'sifatNaskah', 'mediaArsip', 'bahasas', 'satuanUnit')->first();
    	$naskah = Naskah::where([['id_naskah', '=', $id], ['id_user', '=' ,$user->id_user]])->orWhereHas('penerima', function($q) use($user, $id){
    		$q->where('id_user', $user->id_user)->where('id_naskah', $id);
    	})->with('user', 'penerima.user', 'groupPenerima', 'penerima.tujuan_kirim')->get();

    	$naskah1 = Naskah::where('id_naskah', $id)->whereHas('penerima', function($q) use($id){
    		$q->where('id_naskah', $id);
    	})->with('user', 'penerima', 'penerima.user', 'penerima.tujuan_kirim')->with(['files' => function($q) use($id, $getGroup){
    		$q->where('id_naskah', $id)->where('id_group', $getGroup);
    	}])->get();
       	$no = 1;
    	$no1 = 1;
    	$cek = false;
    	return view('log.naskah_keluar.detail', compact('metadataNaskah', 'cek', 'cekTembusan', 'naskah', 'naskah1', 'no', 'no1'));
    }

    public function ubahMetaNaskahKeluar($id)
    {
    	$naskah = Naskah::where('id_naskah', $id)->with('sifatNaskah', 'bahasas', 'mediaArsip', 'satuanUnit', 'jenisNaskah', 'tingkatPerkembangan', 'urgensi')->first();

    	$dataNaskah = Naskah::first();
    	if (is_null($naskah)) {
    		$nomor_agenda = null;
    	}else{
    		$nomor_agenda = Naskah::orderBy('id_naskah', 'desc')->first()->nomor_agenda;
    	}

    	$jenisNaskah = JenisNaskah::all();
    	$perkembangan = Perkembangan::all();
    	$urgensi = Urgensi::all();
    	$sifatNaskah = SifatNaskah::all();
    	$mediaArsip = MediaArsip::all();
    	$bahasa = Bahasa::all();
    	$satuanUnit = SatuanUnit::all();
    	return view('log.naskah_keluar.ubahMetadata', compact('naskah', 'jenisNaskah', 'perkembangan', 'urgensi', 'sifatNaskah', 'mediaArsip', 'bahasa', 'satuanUnit', 'nomor_agenda'));
    }

    public function updateMetaNaskahKeluar(UbahMetadataRequest $request, $id)
    {
    	$input = $request->all();
    	$naskah = Naskah::find($id);

    	$naskah->update($input);

    	return redirect('log/naskah-keluar/detail/'.$id)->with('success', 'Berhasil update metadata');
    }

    public function downloadNaskahKeluar($namaFile)
    {
    	$file = Files::where('nama_file', $namaFile)->first();

    	if (!File::exists('assets/FilesUploaded/'.$file->nama_file)) {
    		return redirect()->back()->withErrors('Tidak dapat menemukan file');
    	}

    	return response()->download('assets/FilesUploaded/'.$file->nama_file);
    }

    public function teruskanNaskahKeluar(Requests $request, $id)
    {
    	$input = $request->all();
    }
}

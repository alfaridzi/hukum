<?php

namespace App\Http\Controllers\Log\RegistrasiNaskahMasuk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Naskah\Naskah;
use App\Model\Penerima;
use App\Model\Pengaturan\JenisNaskah;
use App\Model\Pengaturan\Perkembangan;
use App\Model\Pengaturan\Urgensi;
use App\Model\Pengaturan\SifatNaskah;
use App\Model\Pengaturan\MediaArsip;
use App\Model\Pengaturan\Bahasa;
use App\Model\Pengaturan\SatuanUnit;
use App\Model\Files;
use App\Model\User;

use App\Http\Requests\NaskahMasuk\UbahMetadataRequest;

use Auth;
use File;

class LogController extends Controller
{
    public function rgNaskahMasuk()
    {
    	$user = Auth::user();
    	$naskah = Naskah::where('tipe_registrasi', '1')->whereHas('user', function($q) use($user){
    		$q->where('id_jabatan', $user->id_jabatan);
    	})->with(['penerima' => function($q){
    		$q->where('sebagai', 'to')->groupBy('id_group');
    	}])->with('urgensi')->orderBy('id_naskah', 'asc')->get();
    	$no = 1;
    	return view('log.registrasi_naskah_masuk.index', compact('naskah', 'no'));
    }

    public function detailRgNaskahMasuk($id)
    {
    	$getGroup = Naskah::findOrFail($id)->id_group;
    	$user = Auth::user();
    	$metadataNaskah = Naskah::where('id_naskah', $id)->with('urgensi', 'jenisNaskah', 'tingkatPerkembangan', 'sifatNaskah', 'mediaArsip', 'bahasas', 'satuanUnit')->first();

    	$naskah = Naskah::where('id_group', $getGroup)->whereHas('penerima', function($q) use($user, $id){
    		$q->where('kirim_user', $user->id_user)->orWhere('id_user', $user->id_user);
    	})->with('user', 'penerima', 'groupPenerima', 'penerima.tujuan_kirim')->get();

        // $naskah = Penerima::where('id_group', $getGroup)->where('kirim_user', $user->id_user)->orWhere('id_user', $user->id_user)->with('user')->get();

    	$naskah1 = Naskah::where('id_group', $getGroup)->with('user', 'penerima', 'penerima.user', 'penerima.tujuan_kirim')->with(['files' => function($q) use($id, $getGroup){
    		$q->where('id_naskah', $id)->where('id_group', $getGroup);
    	}])->get();

        $cekNaskah = Naskah::where('id_group', $getGroup)->whereHas('penerima', function($q) use($user){
            $q->where('kirim_user', $user->id_user)->whereNotIn('sebagai', ['to_tl', 'to_keluar']);
        })->with('penerima')->orderBy('id_user', 'desc')->get();

        $dataUser = User::all('id_user', 'nama')->toArray();
        $user = json_encode($dataUser);

       	$no = 1;
    	$no1 = 1;
    	$cek = false;
    	return view('log.registrasi_naskah_masuk.detail', compact('user', 'metadataNaskah', 'cek', 'cekNaskah', 'cekTembusan', 'naskah', 'naskah1', 'no', 'no1'));
    }

    public function ubahMetaRgNaskahMasuk($id)
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
    	return view('log.registrasi_naskah_masuk.ubahMetadata', compact('naskah', 'jenisNaskah', 'perkembangan', 'urgensi', 'sifatNaskah', 'mediaArsip', 'bahasa', 'satuanUnit', 'nomor_agenda'));
    }

    public function updateMetaRgNaskahMasuk(UbahMetadataRequest $request, $id)
    {
    	$input = $request->all();
    	$naskah = Naskah::find($id);

    	$naskah->update($input);

    	return redirect('log/registrasi-naskah-masuk/detail/'.$id)->with('success', 'Berhasil update metadata');
    }

    public function downloadRgNaskahMasuk($namaFile)
    {
    	$file = Files::where('nama_file', $namaFile)->first();

    	if (!File::exists('assets/FilesUploaded/'.$file->nama_file)) {
    		return redirect()->back()->withErrors('Tidak dapat menemukan file');
    	}

    	return response()->download('assets/FilesUploaded/'.$file->nama_file);
    }

    public function teruskanRgNaskahMasuk(Request $request, $id)
    {
    	$input = $request->all();
        $files = $request->file('file_uploads');
        $input['tanggal_registrasi'] = Carbon::now();
        $input['id_user'] = Auth::user()->id_user;

    }
}

<?php

namespace App\Http\Controllers\Log\NaskahTanpaTindakLanjut;

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
use App\Model\Pengaturan\IsiDisposisi;
use App\berkas;
use App\klasifikasi;
use App\Model\Files;
use App\Model\User;
use Storage;
use Carbon\Carbon;

use App\Http\Requests\NaskahMasuk\UbahMetadataRequest;

use Auth;
use File;

class LogController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$naskah = Naskah::where('tipe_registrasi', '5')->whereHas('user', function($q) use($user){
    		$q->where('id_jabatan', $user->id_jabatan);
    	})->with(['penerima' => function($q){
    		$q->where('sebagai', 'to_tl')->groupBy('id_group');
    	}])->orderBy('id_naskah', 'desc')->get();
    	$no = 1;
    	return view('log.naskah_tanpa_tindak_lanjut.index', compact('naskah', 'no'));
    }

    public function detail($id)
    {
        //Berkas
        $userJabatan = Auth::user()->jabatan;
        $sifatNaskah = SifatNaskah::all();
        $klasifikasi = klasifikasi::where('parent_id', '=', 0)->get();
        $dataBerkas = Berkas::all();
        $berkas = berkas::where('id_unitkerja', Auth::user()->id_jabatan)->get();
        if($berkas->count() > 0) {
            $nomor_berkas = $berkas->last()->nomor_berkas + 1;
        } else {
            $nomor_berkas = 1;
        }

        $getNaskah = Naskah::findOrFail($id)->load('berkas');

    	$user = Auth::user();
    	$metadataNaskah = Naskah::where('id_naskah', $id)->with('urgensi', 'jenisNaskah', 'tingkatPerkembangan', 'sifatNaskah', 'mediaArsip', 'bahasas', 'satuanUnit')->first();
    	$naskah = Naskah::where([['id_naskah', '=', $id], ['id_user', '=' ,$user->id_user]])->orWhereHas('penerima', function($q) use($user, $id){
    		$q->where('id_user', $user->id_user)->where('id_naskah', $id);
    	})->with('user', 'penerima.user', 'groupPenerima', 'penerima.tujuan_kirim')->get();

    	$naskah1 = Naskah::where('id_naskah', $id)->whereHas('penerima', function($q) use($id){
    		$q->where('id_naskah', $id);
    	})->with('user', 'penerima', 'penerima.user', 'penerima.tujuan_kirim')->with(['files' => function($q) use($id){
    		$q->where('id_naskah', $id);
    	}])->get();
       	$no = 1;
    	$no1 = 1;
        $no2 = 1;
    	$cek = false;
    	return view('log.naskah_tanpa_tindak_lanjut.detail', compact('metadataNaskah', 'getNaskah', 'cek', 'cekTembusan', 'naskah', 'naskah1', 'no', 'no1', 'userJabatan', 'klasifikasi', 'nomor_berkas', 'dataBerkas', 'no2'));
    }

    public function ubahMetadata($id)
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
    	return view('log.naskah_tanpa_tindak_lanjut.ubahMetadata', compact('naskah', 'jenisNaskah', 'perkembangan', 'urgensi', 'sifatNaskah', 'mediaArsip', 'bahasa', 'satuanUnit', 'nomor_agenda'));
    }

    public function updateMetadata(UbahMetadataRequest $request, $id)
    {
    	$input = $request->all();
    	$naskah = Naskah::find($id);

    	$naskah->update($input);

    	return redirect('log/naskah-tanpa-tindak-lanjut/detail/'.$id)->with('success', 'Berhasil update metadata');
    }

    public function delete(Request $request, $id)
    {
    	$naskah = Naskah::findOrFail($id);
        $penerima = Penerima::where('id_naskah', $id)->get();

        $file = Files::where('id_naskah', $id)->get();

        foreach ($file as $key => $data) {
            if (File::exists('assets/FilesUploaded/'.$naskah->file_dir.'/'.$data->nama_file)) {
                File::delete('assets/FilesUploaded/'.$naskah->file_dir.'/'.$data->nama_file);
            }
            $data->delete();
        }

        foreach ($penerima as $data) {
            $data->delete();
        }

        $naskah->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus naskah');
    }
}

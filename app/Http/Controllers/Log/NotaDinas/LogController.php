<?php

namespace App\Http\Controllers\Log\NotaDinas;

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
    public function notaDinas()
    {
    	$user = Auth::user();
    	$naskah = Naskah::where('tipe_registrasi', '3')->whereHas('user', function($q) use($user){
    		$q->where('id_jabatan', $user->id_jabatan);
    	})->with(['penerima' => function($q){
    		$q->where('sebagai', 'to_konsep')->groupBy('id_group');
    	}])->with('urgensi')->with(['getPenerima' => function($q){
            $q->groupBy('id_group');
        }])->orderBy('id_naskah', 'asc')->get();
        $no = 1;
    	return view('log.nota_dinas.index', compact('naskah', 'no'));
    }

    public function detailNotaDinas($id)
    {
    	$sifatNaskah = SifatNaskah::all();
        $isiDisposisi = IsiDisposisi::all();
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
        $update = Penerima::where('id_naskah', $id)->where('kirim_user', $user->id_user)->get();
        if (!$update->isEmpty()) {
            foreach($update as $data)
            {
                $data->update(['status_naskah' => '1']);
            }
        }
        $metadataNaskah = Naskah::where('id_naskah', $id)->with('urgensi', 'jenisNaskah', 'tingkatPerkembangan', 'sifatNaskah', 'mediaArsip', 'bahasas', 'satuanUnit')->first();

        $naskah = Penerima::where('id_naskah', $id)->where(function($q) use($user, $id){
            $q->WhereHas('tujuan_kirim', function($query) use ($user){
                $query->where('id_jabatan', $user->id_jabatan);
            })->orWhereHas('user', function($query) use($user){
                $query->where('id_jabatan', $user->id_jabatan);
            });
        })->with('user')->with(['files' => function($q) use($id){
            $q->where('id_naskah', $id);
        }])->with(['disposisi' => function($q) use($id){
            $q->where('id_naskah', $id);
        }])->groupBy('id_group')->orderBy('id_penerima', 'DESC')->get();

        $naskah1 = Penerima::where('id_naskah', $id)->groupBy('id_group')->with('user')->with(['files' => function($q) use($id){
            $q->where('id_naskah', $id);
        }])->with(['disposisi' => function($q) use($id){
            $q->where('id_naskah', $id);
        }])->orderBy('id_penerima', 'desc')->get();

        $cekNaskah = Penerima::where('id_naskah', $id)->whereNotIn('sebagai', ['to_tl', 'bcc'])->whereHas('tujuan_kirim', function($q) use($user){
            $q->where('id_jabatan', $user->id_jabatan);
        })->orderBy('id_user', 'desc')->get();

        $dataUser = User::whereNotIn('id_user', [$user->id_user])->with('jabatan')->get()->toArray();
        $user = json_encode($dataUser);

        $no = 1;
        $no1 = 1;
        $no2 = 1;
        $cek = false;
        $cek1 = false;
    	return view('log.nota_dinas.detail', compact('user', 'metadataNaskah', 'cek', 'cek1', 'cekNaskah', 'cekTembusan', 'naskah', 'naskah1', 'no', 'no1', 'no2', 'getNaskah', 'userJabatan', 'klasifikasi', 'berkas', 'nomor_berkas', 'dataBerkas', 'sifatNaskah', 'isiDisposisi'));
    }

    public function ubahMetaNotaDinas($id)
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
    	return view('log.nota_dinas.ubahMetadata', compact('naskah', 'jenisNaskah', 'perkembangan', 'urgensi', 'sifatNaskah', 'mediaArsip', 'bahasa', 'satuanUnit', 'nomor_agenda'));
    }

    public function updateMetaNotaDinas(UbahMetadataRequest $request, $id)
    {
    	$input = $request->all();
    	$naskah = Naskah::find($id);

    	$naskah->update($input);

    	return redirect('log/nota-dinas/detail/'.$id)->with('success', 'Berhasil update metadata');
    }

    public function downloadNotaDinas($namaFile)
    {
    	$file = Files::where('nama_file', $namaFile)->first();

    	if (!File::exists('assets/FilesUploaded/'.$file->nama_file)) {
    		return redirect()->back()->withErrors('Tidak dapat menemukan file');
    	}

    	return response()->download('assets/FilesUploaded/'.$file->nama_file);
    }

    public function teruskanNotaDinas(Requests $request, $id)
    {
    	$input = $request->all();
    }
}

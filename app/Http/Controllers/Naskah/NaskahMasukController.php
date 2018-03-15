<?php

namespace App\Http\Controllers\Naskah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Naskah\NaskahMasukController;

use App\Http\Requests\NaskahMasuk\UbahMetadataRequest;

use App\Model\Naskah\Naskah;
use App\Model\Pengaturan\JenisNaskah;
use App\Model\Pengaturan\Perkembangan;
use App\Model\Pengaturan\Urgensi;
use App\Model\Pengaturan\SifatNaskah;
use App\Model\Pengaturan\MediaArsip;
use App\Model\Pengaturan\Bahasa;
use App\Model\Pengaturan\SatuanUnit;
use App\Model\Pengaturan\IsiDisposisi;
use App\Model\Penerima;
use App\Model\User;
use App\berkas;
use App\klasifikasi;

use Auth;

class NaskahMasukController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
        $naskah = Naskah::whereNotIn('tipe_registrasi', ['5'])->whereHas('penerima', function($q) use($user){
            $q->whereHas('tujuan_kirim', function($q) use($user){
                $q->where('id_user', $user->id_user)->orWhere('id_jabatan', $user->id_jabatan);
            })->orderBy('id_penerima', 'asc')->groupBy('id_naskah');
        })->with('urgensi')->with(['penerima' => function($q) use($user){
            $q->whereHas('tujuan_kirim', function($q) use($user){
                $q->where('id_user', $user->id_user)->orWhere('id_jabatan', $user->id_jabatan);
            })->orderBy('id_penerima', 'asc')->groupBy('id_naskah');
        }])->orderBy('id_naskah', 'desc')->get();

    	$no = 1;
    	return view('naskah_masuk.naskah_masuk', compact('naskah', 'no'));
    }

    public function detail($id)
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
    	return view('naskah_masuk.detail_naskah_masuk', compact('user', 'metadataNaskah', 'cek', 'cek1', 'cekNaskah', 'cekTembusan', 'naskah', 'naskah1', 'no', 'no1', 'no2', 'getNaskah', 'userJabatan', 'klasifikasi', 'berkas', 'nomor_berkas', 'dataBerkas', 'sifatNaskah', 'isiDisposisi'));
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
    	return view('naskah_masuk.ubah_metadata', compact('naskah', 'jenisNaskah', 'perkembangan', 'urgensi', 'sifatNaskah', 'mediaArsip', 'bahasa', 'satuanUnit', 'nomor_agenda'));
    }

    public function updateMetadata(UbahMetadataRequest $request, $id)
    {
    	$input = $request->all();
        $naskah = Naskah::find($id);

        $naskah->update($input);

    	return redirect('naskah-masuk/detail/'.$id)->with('success', 'Berhasil update metadata');
    }
}

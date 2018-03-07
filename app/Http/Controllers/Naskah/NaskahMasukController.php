<?php

namespace App\Http\Controllers\Naskah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Naskah\NaskahMasukController;

use App\Http\Requests\NaskahMasuk\UbahMetadataRequest;

use App\Model\Naskah\Naskah;
use App\Model\Naskah\DetailNaskah;
use App\Model\Pengaturan\JenisNaskah;
use App\Model\Pengaturan\Perkembangan;
use App\Model\Pengaturan\Urgensi;
use App\Model\Pengaturan\SifatNaskah;
use App\Model\Pengaturan\MediaArsip;
use App\Model\Pengaturan\Bahasa;
use App\Model\Pengaturan\SatuanUnit;

class NaskahMasukController extends Controller
{
    public function index()
    {
    	$naskah = Naskah::with('detail', 'urgensi')->get();
    	$no = 1;
    	return view('naskah_masuk.naskah_masuk', compact('naskah', 'no'));
    }

    public function detail($id)
    {
    	$naskah = Naskah::where('id_naskah', $id)->with('detail.sifatNaskah', 'detail.bahasas', 'detail.mediaArsip', 'detail.satuanUnit', 'jenisNaskah', 'detail.tingkatPerkembangan', 'urgensi')->first();
    	$no = 1;
    	$no1 = 1;
    	return view('naskah_masuk.detail_naskah_masuk', compact('naskah', 'no', 'no1'));
    }

    public function ubahMetadata($id)
    {
    	$naskah = Naskah::where('id_naskah', $id)->with('detail.sifatNaskah', 'detail.bahasas', 'detail.mediaArsip', 'detail.satuanUnit', 'jenisNaskah', 'detail.tingkatPerkembangan', 'urgensi')->first();

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

    	$detail = DetailNaskah::where('id_naskah', $id)->first();
    	$detail->update($input);

    	return redirect('naskah-masuk/detail/'.$id)->with('success', 'Berhasil update metadata');
    }
}

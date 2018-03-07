<?php

namespace App\Http\Controllers\Naskah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\RegistrasiNaskah\RegistrasiNaskahRequest;

use App\Model\Naskah\Naskah;
use App\Model\Pengaturan\JenisNaskah;
use App\Model\Pengaturan\Urgensi;
use App\Model\Pengaturan\SifatNaskah;
use App\Model\Pengaturan\MediaArsip;
use App\Model\Pengaturan\Bahasa;
use App\Model\Pengaturan\SatuanUnit;

use Storage;
use Carbon\Carbon;
use File;

class RegistrasiNaskahController extends Controller
{
    public function index()
    {
    	$jenisNaskah = JenisNaskah::all();
    	$naskah = Naskah::all();
    	if (is_null($naskah)) {
    		$nomor_agenda = null;
    	}else{
    		$nomor_agenda = Naskah::orderBy('id_naskah', 'desc')->first()->nomor_agenda;
    	}
    	$urgensi = Urgensi::all();
    	return view('registrasi_naskah.tambah_naskah', compact('jenisNaskah', 'urgensi', 'nomor_agenda'));
    }

    public function simpan(RegistrasiNaskahRequest $request)
    {
    	$input = $request->all();
    	$files = $request->file('file_uploads');
    	$input['tanggal_registrasi'] = Carbon::now();
    	$arrFiles = array();
    	if ($input['tipe_registrasi'] == 5) {
    		$input['kepada'] = null;
    		$input['tembusan'] = null;
    	}
    	if (!is_null($files)) {
    		foreach ($files as $key => $file) {
    			$namaFile = substr(str_random(5).'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 30).'.'.$file->getClientOriginalExtension();
    			$arrFiles[] = $namaFile;
    			Storage::disk('uploads')->putFileAs('uploads/FileUploads', $file, $namaFile);
    		}
    		$input['file_uploads'] = serialize($arrFiles);
    	}
    	
    	Naskah::create($input);

    	$naskah = Naskah::orderBy('id_naskah', 'desc')->first();

    	$detail['perkembangan'] = Perkembangan::firstOrFail()->id_perkembangan;
    	$detail['sifat_naskah'] = SifatNaskah::firstOrFail()->id_sifat_naskah;
    	$detail['media_arsip'] = MediaArsip::firstOrFail()->id_media_arsip;
    	$detail['bahasa'] = Bahasa::firstOrFail()->id_bahasa;
    	$detail['satuan_unit'] = SatuanUnit::firstOrFail()->id_satuan;

    	$naskah->detail()->create($detail);

    	return redirect()->back()->with('success', 'Berhasil mengirim naskah');
    }
}

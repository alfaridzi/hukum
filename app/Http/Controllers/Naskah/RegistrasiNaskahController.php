<?php

namespace App\Http\Controllers\Naskah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\RegistrasiNaskah\RegistrasiNaskahRequest;

use App\Model\Naskah\Naskah;
use App\Model\User;
use App\Model\Files;
use App\Model\Penerima;
use App\Model\Pengaturan\JenisNaskah;
use App\Model\Pengaturan\Urgensi;
use App\Model\Pengaturan\SifatNaskah;
use App\Model\Pengaturan\MediaArsip;
use App\Model\Pengaturan\Bahasa;
use App\Model\Pengaturan\SatuanUnit;
use App\Model\Pengaturan\Perkembangan;
use App\berkas;

use Auth;

use Storage;
use Carbon\Carbon;
use File;

class RegistrasiNaskahController extends Controller
{
    public function index()
    {


        $berkas = berkas::where('id_unitkerja', Auth::user()->id_jabatan)->get();
        $no = 1;
    	$jenisNaskah = JenisNaskah::all();
        $user = Auth::user();
    	$naskah = Naskah::first();
    	if (is_null($naskah)) {
    		$nomor_agenda = null;
    	}else{
    		$nomor_agenda = Naskah::orderBy('id_naskah', 'desc')->first()->nomor_agenda;
    	}
    	$urgensi = Urgensi::all();
        $dataUser = User::whereNotIn('id_user', [$user->id_user])->with('jabatan')->get()->toArray();
        $user = json_encode($dataUser);
    	return view('registrasi_naskah.tambah_naskah', compact('jenisNaskah', 'urgensi', 'nomor_agenda', 'user','berkas','no'));
    }

    public function simpan(RegistrasiNaskahRequest $request)
    {
    	$input = $request->all();
    	$files = $request->file('file_uploads');
    	$input['tanggal_registrasi'] = Carbon::now();
        $input['id_user'] = Auth::user()->id_user;
        $id_group = Naskah::all()->last();
        $input['id_group'] = null;
        if (is_null($id_group)) {
            $input['id_group'] += 1;
        }else{
            $input['id_group'] = $id_group->id_group + 1;
        }
        $input['tingkat_perkembangan'] = Perkembangan::firstOrFail()->id_perkembangan;
        $input['sifat_naskah'] = SifatNaskah::firstOrFail()->id_sifat_naskah;
        $input['media_arsip'] = MediaArsip::firstOrFail()->id_media_arsip;
        $input['bahasa'] = Bahasa::firstOrFail()->id_bahasa;
        $input['satuan_unit'] = SatuanUnit::firstOrFail()->id_satuan;
    	if ($input['tipe_registrasi'] == 5) {
    		$input['kepada'] = null;
    		$input['tembusan'] = null;
    	}

        if ($input['tipe_registrasi'] == 1) {
            $tipe = 'in';
        }elseif($input['tipe_registrasi'] == 2) {
            $tipe = 'memo';
        }elseif($input['tipe_registrasi'] == 3) {
            $tipe = 'keluar';
        }elseif($input['tipe_registrasi'] == 4) {
            $tipe = 'out';
        }elseif($input['tipe_registrasi'] == 5) {
            $tipe = 'tl';
        }

        $input['file_dir'] = Auth::user()->id_user.'-'.$tipe.'-'.$input['id_group'];
        mkdir('assets/FilesUploaded/'.$input['file_dir']);
        Naskah::create($input);
        $last_id = Naskah::all()->last();

    	if (!is_null($files)) {
    		foreach ($files as $key => $file) {
    			$namaFile = substr(str_random(5).'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 30).'.'.$file->getClientOriginalExtension();
    			$arrFiles[] = $namaFile;
    			Storage::disk('uploads')->putFileAs('FilesUploaded/'.$input['file_dir'].'/', $file, $namaFile);
                Files::create(['id_naskah' => $last_id->id_naskah, 'id_group' => $input['id_group'], 'nama_file' => $namaFile]);
    		}
    	}

        if (is_null($input['tembusan'])) {
            $tembusan = null;
        }else{
            $input['tembusan'] = explode(",", $input['tembusan']);
            $tembusan = $input['tembusan'];
        }

        if (is_null($input['kepada'])) {
            $data1 = null;
        }else{
            $input['kepada'] = explode(',', $input['kepada']);
            $data1 = $input['kepada'];
        }

        $kepada['id_naskah'] = $last_id->id_naskah;
        $kepada['id_group'] = $input['id_group'];

        if ($input['tipe_registrasi'] == 1) {
            $kepada['sebagai'] = 'to';
        }elseif($input['tipe_registrasi'] == 2) {
            $kepada['sebagai'] = 'to_memo';
        }elseif($input['tipe_registrasi'] == 3) {
            $kepada['sebagai'] = 'to_konsep';
        }elseif($input['tipe_registrasi'] == 4) {
            $kepada['sebagai'] = 'to_keluar';
        }elseif($input['tipe_registrasi'] == 5) {
            $kepada['sebagai'] = 'to_tl';
            $kepada['kirim_user'] = Auth::user()->id_user;
            Penerima::create($kepada);
        }

        if (!is_null($data1)) {
            foreach ($data1 as $key => $data) {
                $kepada['id_user'] = $input['id_user'];
                $kepada['kirim_user'] = $data;
                Penerima::create($kepada);
            }
        }

        $penerima['id_group'] = $input['id_group'];
        $penerima['id_naskah'] = $last_id->id_naskah;
        if (!is_null($tembusan)) {
            foreach ($tembusan as $key => $data) {
                $penerima['id_user'] = $input['id_user'];
                $penerima['sebagai'] = 'bcc';
                $penerima['kirim_user'] = $data;
                Penerima::create($penerima);
            }
        }

    	return redirect()->back()->with('success', 'Berhasil mengirim naskah');
    }
}

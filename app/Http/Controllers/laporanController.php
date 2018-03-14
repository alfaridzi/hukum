<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Naskah\Naskah;
use PDF;
use App\Model\Penerima;
use App\Model\User;
use Auth;
use App\berkas;

class laporanController extends Controller
{
    public function index() {
    	$naskah = naskah::where('tipe_registrasi','1')->get();
    	//dd($naskah);
    	$no = 1;
    		return view('laporan', compact('no','naskah'));
    	
    	$pdf = PDF::loadView('laporan',['naskah'=>$naskah, 'no' => $no]);

    	return $pdf->stream('laporan.pdf');
    }
 

    public function reg_naskah_tanpa_tindak_lanjut() {
    		$naskah = naskah::where('tipe_registrasi','5')->get();
    	//dd($naskah);
    	$no = 1;
    		return view('laporan_tanpa_tindak_lanjut', compact('no','naskah'));
    	
    	$pdf = PDF::loadView('laporan_tanpa_tindak_lanjut',['naskah'=>$naskah, 'no' => $no]);

    	return $pdf->stream('laporan.pdf');
    }


    public function naskah_masuk() {
    	 $user = Auth::user();
        $naskah = Naskah::whereNotIn('tipe_registrasi', ['5'])->whereHas('penerima', function($q) use($user){
            $q->whereHas('tujuan_kirim', function($q) use($user){
                $q->where('id_user', $user->id_user)->orWhere('id_jabatan', $user->id_jabatan);
            })->orderBy('id_penerima', 'asc')->groupBy('id_naskah');
        })->with('urgensi')->with(['penerima' => function($q) use($user){
            $q->whereHas('tujuan_kirim', function($q) use($user){
                $q->where('id_user', $user->id_user)->orWhere('id_jabatan', $user->id_jabatan);
            })->orderBy('id_penerima', 'asc')->groupBy('id_naskah');
        }])->orderBy('id_naskah', 'asc')->get();

    	//dd($naskah);
    	$no = 1;
    		return view('laporan_naskah_masuk', compact('no','naskah'));
    	
    	$pdf = PDF::loadView('laporan_naskah_masuk',['naskah'=>$naskah, 'no' => $no]);

    	return $pdf->stream('laporan.pdf');
    }

    public function berkas() {

    	$berkas = berkas::where('id_unitkerja', Auth::user()->id_jabatan)->get();
    	$no = 1;
    		return view('laporan_berkas', compact('no','berkas'));
    	
    	$pdf = PDF::loadView('laporan_berkas',['naskah'=>$naskah, 'no' => $no]);

    	return $pdf->stream('laporan.pdf');
    }
}

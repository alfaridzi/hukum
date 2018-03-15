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
    	return view('laporan');
    }

    public function reg_masuk() {
    	$user = Auth::user();

    	$dari = $_GET['dari'];
    	$sampai = $_GET['sampai'];

    	$naskah = Naskah::where('tipe_registrasi', '1')->whereBetween('created_at', [$dari, $sampai])->whereHas('user', function($q) use($user){
    		$q->where('id_jabatan', $user->id_jabatan);
    	})->with(['penerima' => function($q){
    		$q->where('sebagai', 'to')->groupBy('id_group');
    	}])->with('urgensi')->with(['getPenerima' => function($q){
            $q->groupBy('id_group');
        }])->orderBy('id_naskah', 'asc')->get();
    	//dd($naskah);
    	$no = 1;
    	
    	$pdf = PDF::loadView('laporan_reg_masuk',['naskah'=>$naskah, 'no' => $no]);

    	return $pdf->stream('laporan.pdf');
    }
 

    public function reg_naskah_tanpa_tindak_lanjut() {
    	$user = Auth::user();


    	$dari = $_GET['dari'];
    	$sampai = $_GET['sampai'];
    	

    	$naskah = Naskah::where('tipe_registrasi', '5')->whereBetween('created_at', [$dari, $sampai])->whereHas('user', function($q) use($user){
    		$q->where('id_jabatan', $user->id_jabatan);
    	})->with(['penerima' => function($q){
    		$q->where('sebagai', 'to_tl')->groupBy('id_group');
    	}])->orderBy('id_naskah', 'asc')->get();

    	//dd($naskah);
    	$no = 1;
    	
    	$pdf = PDF::loadView('laporan_tanpa_tindak_lanjut',['naskah'=>$naskah, 'no' => $no]);

    	return $pdf->stream('laporan.pdf');
    }


    public function naskah_masuk() {
    	 $user = Auth::user();


    	 $dari = $_GET['dari'];
    	$sampai = $_GET['sampai'];


        $naskah = Naskah::whereNotIn('tipe_registrasi', ['5'])->whereBetween('created_at', [$dari, $sampai])->whereHas('penerima', function($q) use($user){
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

    	
    	$pdf = PDF::loadView('laporan_naskah_masuk',['naskah'=>$naskah, 'no' => $no]);

    	return $pdf->stream('laporan.pdf');
    }


    public function naskah_keluar() {
    	 $user = Auth::user();

    	 $dari = $_GET['dari'];
    	$sampai = $_GET['sampai'];

        $naskah = Naskah::whereNotIn('tipe_registrasi', ['1','5'])->whereBetween('created_at', [$dari, $sampai])->whereHas('user', function($q) use($user){
    		$q->where('id_jabatan', $user->id_jabatan);
    	})->with(['penerima' => function($q){
    		$q->where('sebagai', 'to_tl')->groupBy('id_group');
    	}])->orderBy('id_naskah', 'asc')->get();



    	//dd($naskah);
    	$no = 1;

    	
    	//$pdf = PDF::loadView('laporan_naskah_keluar',['naskah'=>$naskah, 'no' => $no]);

    	return view('laporan_naskah_keluar', compact('naskah','no'));

    	return $pdf->stream('laporan.pdf');
    }

    public function berkas() {

    	$dari = $_GET['dari'];
    	$sampai = $_GET['sampai'];

    	$berkas = berkas::where('id_unitkerja', Auth::user()->id_jabatan)->whereBetween('created_at', [$dari, $sampai])->get();
    	$no = 1;
    		
    	
    	$pdf = PDF::loadView('laporan_berkas',['berkas'=>$berkas, 'no' => $no]);

    	return $pdf->stream('laporan.pdf');
    }
}

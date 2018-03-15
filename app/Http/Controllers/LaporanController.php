<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Naskah\Naskah;
use App\Model\Penerima;

use App\Http\Requests\LaporanRequest;

use Auth;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
    	return view('laporan');
    }

    public function naskahKeluar(LaporanRequest $request)
    {
    	$input = $request->all();
    	$tanggalAwal = Carbon::parse($input['tanggal_awal'])->startOfDay();
    	$tanggalAkhir = Carbon::parse($input['tanggal_akhir'])->endOfDay();
    	$user = Auth::user();

    	$naskah1 = Penerima::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->where(function($q) use($user){
            $q->WhereHas('tujuan_kirim', function($query) use ($user){
                $query->where('id_jabatan', $user->id_jabatan);
            })->orWhereHas('user', function($query) use($user){
                $query->where('id_jabatan', $user->id_jabatan);
            });
        })->with('user')->groupBy('id_group')->orderBy('id_penerima', 'DESC')->get();
        
    	dd($naskah1);
    }

    public function naskahMasuk()
    {

    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Penerima extends Model
{
    protected $table = 'tbl_penerima';
    protected $fillable = ['id_naskah', 'id_group', 'id_user', 'sebagai', 'pesan', 'kirim_user', 'status_naskah', 'updated_at'];
    protected $primaryKey = 'id_penerima';

    public function disposisi()
    {
        return $this->hasMany('App\Model\Disposisi', 'id_group', 'id_group');
    }

    public function get_status_naskah()
    {
    	if ($this->status_naskah == '0') {
    		return 'Belum Dibaca';
    	}elseif($this->status_naskah == '1') {
    		return 'Sudah Dibaca';
    	}
    }

    public function statusNaskah()
    {
        $status = $this->where('id_naskah', $this->id_naskah)->whereNotIn('sebagai', ['bcc'])->where('status_naskah', '0')->get();

        if ($status->isEmpty()) {
            return 'Sudah Dibaca';
        }else{
            return 'Belum Dibaca';
        }
        // $sebagai = $this->where('id_naskah', $this->id_naskah)->where('kirim_user', Auth::user()->id_user)->whereIn('status_naskah', ['0'])->first();

        // if ($this->kirim_user == Auth::user()->id_user && $this->status_naskah == 0) {
        //     return 'Belum Dibaca';
        // }else{

        // }

        // if (is_null($sebagai)) {
        //     return 'Sudah Dibaca';
        // }else{
        //     return 'Belum Dibaca';
        // }
    }

    public function get_sebagai()
    {
        $sebagai = $this->where('id_naskah', $this->id_naskah)->where('id_group', $this->id_group)->groupBy('id_group')->first();

        if ($sebagai->sebagai == 'to') {
            return 'Surat Masuk';
        }elseif($sebagai->sebagai == 'to_reply'){
            return 'Nota Dinas';
        }elseif($sebagai->sebagai == 'to_usul'){
            return 'Nota Dinas';
        }elseif($sebagai->sebagai == 'to_konsep'){
            return 'Nota Dinas';
        }elseif($sebagai->sebagai == 'to_forward'){
            return 'Teruskan';
        }elseif($sebagai->sebagai == 'to_keluar'){
            return 'Naskah Keluar';
        }elseif($sebagai->sebagai == 'to_tl'){
            return 'Naskah Tanpa Tindak Lanjut';
        }elseif($sebagai->sebagai == 'to_memo'){
            return 'Memo';
        }elseif($sebagai->sebagai == 'cc1'){
            return 'Disposisi';
        }elseif($sebagai->sebagai == 'final'){
            return 'Dokumen Final';
        }
    }

    public function get_tujuan()
    {
        return $this->where('id_naskah', $this->id_naskah)->where('id_group', $this->id_group)->get();
    }

    public function naskah()
    {
        return $this->belongsTo('App\Model\Naskah\Naskah', 'id_naskah', 'id_naskah');
    }

    public function user()
    {
    	return $this->belongsTo('App\Model\User', 'id_user', 'id_user');
    }

    public function tujuan_kirim()
    {
        return $this->belongsTo('App\Model\User', 'kirim_user', 'id_user');
    }

    public function files()
    {
        return $this->hasMany('App\Model\Files', 'id_group', 'id_group');
    }
}

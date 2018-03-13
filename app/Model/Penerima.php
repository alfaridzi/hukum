<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    protected $table = 'tbl_penerima';
    protected $fillable = ['id_naskah', 'id_group', 'id_user', 'sebagai', 'pesan', 'kirim_user', 'status_naskah', 'updated_at'];
    protected $primaryKey = 'id_penerima';

    public function get_status_naskah()
    {
    	if ($this->status_naskah == '0') {
    		return 'Belum Dibaca';
    	}elseif($this->status_naskah == '1') {
    		return 'Sudah Dibaca';
    	}
    }

    public function get_sebagai()
    {
        $sebagai = $this->where('id_group', $this->id_group)->where('id_naskah', $this->id_naskah)->groupBy('id_group')->first();

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
        }
    }

    public function get_tujuan()
    {
        return $this->where('id_group', $this->id_group)->get();
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

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
        if ($this->sebagai == 'to') {
            return 'Surat Masuk';
        }elseif($this->sebagai == 'to_reply'){
            return 'Nota Dinas';
        }elseif($this->sebagai == 'to_forward'){
            return 'Teruskan';
        }elseif($this->sebagai == 'to_keluar'){
            return 'Naskah Keluar';
        }elseif($this->sebagai == 'to_tl'){
            return 'Naskah Tanpa Tindak Lanjut';
        }elseif($this->sebagai == 'to_memo'){
            return 'Memo';
        }
    }

    public function user()
    {
    	return $this->belongsTo('App\Model\User', 'id_user', 'id_user');
    }

    public function tujuan_kirim()
    {
        return $this->belongsTo('App\Model\User', 'kirim_user', 'id_user');
    }
}

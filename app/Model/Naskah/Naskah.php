<?php

namespace App\Model\Naskah;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Naskah extends Model
{
    protected $table = 'tbl_naskah';
    protected $fillable = ['id_user', 'jenis_naskah', 'tanggal_naskah', 'tanggal_registrasi', 'nomor_naskah', 'nomor_agenda', 'hal', 'asal_naskah', 'tingkat_urgensi', 'berkas', 'kepada', 'tembusan', 'file_uploads', 'tipe_registrasi', 'status_naskah'];
    protected $primaryKey = 'id_naskah';

    public function detail()
    {
    	return $this->hasOne('App\Model\Naskah\DetailNaskah', 'id_naskah', 'id_naskah');
    }

    public function urgensi()
    {
    	return $this->belongsTo('App\Model\Pengaturan\Urgensi', 'tingkat_urgensi', 'id_urgensi');
    }

    public function status_naskah()
    {
    	if ($this->status_naskah == 0) {
    		return 'Belum dibaca';
    	}elseif($this->status_naskah == 1) {
    		return 'Sudah dibaca';
    	}
    }

    public function jenisNaskah()
    {
    	return $this->belongsTo('App\Model\Pengaturan\JenisNaskah', 'jenis_naskah', 'id_jenis_naskah');
    }

    public function get_tanggal_naskah()
    {
   		$tanggal = $this->tanggal_naskah;
   		return Carbon::parse($tanggal)->formatLocalized('%d %B %Y');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berkas extends Model
{
    protected $table = 'tbl_berkas';

    protected $primaryKey = 'id_berkas';

    protected $fillable = ['id_unitkerja','kode_klasifikasi','nomor_berkas','judul_berkas','status_retensi','retensi_dari','r_aktif','r_inaktif','penyusutan_akhir','lokasi_fisik','isi_ringkas'];

    public function status_berkas() {
    	if($this->status_retensi == '1') {
    		return "<a href='berkas/tutup/".$this->id_berkas."' class='btn btn-xs btn-danger' style='border-radius:0px'>Tutup Berkas</a>";
    	} else {
    		return  "<button readonly='' class='btn btn-xs bg-danger'>Berkas Ditutup</button>";
    	}
    }

    public function jabatan() {
        return $this->hasOne('App\unitKerja','id','id_unitkerja') ;
    }

    public function klasifikasi() {
    	return $this->hasOne('App\klasifikasi','kode','kode_klasifikasi');
    }

    public function naskah() {
    	return $this->hasMany('App\Model\Naskah\Naskah','id_berkas','id_berkas');
    }
}

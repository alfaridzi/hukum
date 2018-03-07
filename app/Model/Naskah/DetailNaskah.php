<?php

namespace App\Model\Naskah;

use Illuminate\Database\Eloquent\Model;

class DetailNaskah extends Model
{
    protected $table = 'tbl_detail';
    protected $fillable = ['id_naskah', 'perkembangan', 'sifat_naskah', 'kategori_arsip', 'akses_publik', 'media_arsip', 'bahasa', 'isi_ringkas', 'vital', 'jumlah', 'satuan_unit', 'lokasi_fisik', 'updated_at'];
    protected $primaryKey = 'id_detail';

    public function kategori_arsip()
    {
    	if ($this->kategori_arsip == 0) {
    		return 'Umum';
    	}elseif($this->kategori_arsip == 1) {
    		return 'Terjaga';
    	}
    }

    public function akses_publik()
    {
    	if ($this->akses_publik == 0) {
    		return 'Terbuka';
    	}elseif($this->akses_publik == 1) {
    		return 'Tertutup';
    	}
    }

    public function vital()
    {
    	if ($this->vital == 0) {
    		return 'Tidak Vital';
    	}elseif($this->vital == 1) {
    		return 'Vital';
    	}
    }

    public function naskah()
    {
    	return $this->belongsTo('App\Model\Naskah\Naskah', 'id_naskah', 'id_naskah');
    }

    public function sifatNaskah()
    {
    	return $this->belongsTo('App\Model\Pengaturan\SifatNaskah', 'sifat_naskah', 'id_sifat_naskah');
    }

    public function mediaArsip()
    {
    	return $this->belongsTo('App\Model\Pengaturan\MediaArsip', 'media_arsip', 'id_media_arsip');
    }

    public function bahasas()
    {
    	return $this->belongsTo('App\Model\Pengaturan\Bahasa', 'bahasa', 'id_bahasa');
    }

    public function satuanUnit()
    {
    	return $this->belongsTo('App\Model\Pengaturan\SatuanUnit', 'satuan_unit', 'id_satuan');
    }

    public function tingkatPerkembangan()
    {
        return $this->belongsTo('App\Model\Pengaturan\Perkembangan', 'perkembangan', 'id_perkembangan');
    }
}

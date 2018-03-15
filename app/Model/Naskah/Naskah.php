<?php

namespace App\Model\Naskah;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Model\Penerima;
use Auth;

class Naskah extends Model
{
    protected $table = 'tbl_naskah';

    protected $fillable = ['id_group', 'id_user', 'id_berkas', 'jenis_naskah', 'tanggal_naskah', 'tanggal_registrasi', 'nomor_naskah', 'nomor_agenda', 'hal', 'asal_naskah', 'tingkat_urgensi', 'berkas', 'tingkat_perkembangan', 'sifat_naskah', 'kategori_arsip', 'akses_publik', 'media_arsip', 'bahasa', 'isi_ringkas', 'vital', 'jumlah', 'satuan_unit', 'lokasi_fisik', 'file_dir', 'tipe_registrasi', 'updated_at'];

    protected $primaryKey = 'id_naskah';

    public function urgensi()
    {
    	return $this->belongsTo('App\Model\Pengaturan\Urgensi', 'tingkat_urgensi', 'id_urgensi');
    }


    public function get_tujuan()
    {
        return Penerima::where('id_naskah', $this->id_naskah)->where('id_group', $this->id_group)->get();
    }


    public function berkas() {
        return $this->hasOne('App\berkas','id_berkas','id_berkas');
    }

    public function penerimas() {
        return $this->hasOne('App\Model\Penerima', 'id_naskah', 'id_naskah');
    }

    public function getPenerima() {
        return $this->hasMany('App\Model\Penerima', 'id_naskah', 'id_naskah');
    }

    public function tingkatPerkembangan()
    {
        return $this->belongsTo('App\Model\Pengaturan\Perkembangan', 'tingkat_perkembangan', 'id_perkembangan');
    }

    public function sifatNaskah()
    {
        return $this->belongsTo('App\Model\Pengaturan\SifatNaskah', 'sifat_naskah', 'id_sifat_naskah');
    }

    public function penerima()
    {
        return $this->hasMany('App\Model\Penerima', 'id_naskah', 'id_naskah');
    }

    public function groupPenerima()
    {
        return $this->hasMany('App\Model\Penerima', 'id_naskah', 'id_naskah')->groupBy('id_group');
    }

    public function groupFiles()
    {
        return $this->hasMany('App\Model\Files', 'id_naskah', 'id_naskah')->groupBy('id_group');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_user', 'id_user');
    }

    public function files()
    {
        return $this->hasMany('App\Model\Files', 'id_naskah', 'id_naskah');
    }

    public function get_kategori_arsip()
    {
        if ($this->kategori_arsip == '1') {
            return 'Terjaga';
        }elseif($this->kategori_arsip == '0'){
            return 'Umum';
        }
    }

    public function axis() {
        return Penerima::where('id_naskah', $this->id_naskah)->where('sebagai','to')->get();
    }


     public function axis_xs() {

        $id_reg =  $this->tipe_registrasi;


        if($id_reg === '4') {
                 return Penerima::where('id_naskah', $this->id_naskah)->where('sebagai','to_keluar')->get();
        } else if($id_reg === '3') {
                 return Penerima::where('id_naskah', $this->id_naskah)->where('sebagai','to_konsep')->get();
        } else if($id_reg === '2') {
                return Penerima::where('id_naskah', $this->id_naskah)->where('sebagai','to_memo')->get();
        }
    }

    public function axis_nm() { //nskh masuk
        return Auth::user()->jabatan->jabatan;
    }

    public function get_akses_publik()
    {
        if ($this->akses_publik == '1') {
            return 'Tertutup';
        }elseif($this->akses_publik == '0'){
            return 'Terbuka';
        }
    }

    public function mediaArsip()
    {
        return $this->belongsTo('App\Model\Pengaturan\MediaArsip', 'media_arsip', 'id_media_arsip');
    }

    public function bahasas()
    {
        return $this->belongsTo('App\Model\Pengaturan\Bahasa', 'bahasa', 'id_bahasa');
    }

    public function get_vital()
    {
        if ($this->vital == '1') {
            return 'Vital';
        }elseif($this->vital == '0') {
            return 'Tidak Vital';
        }
    }

    public function satuanUnit()
    {
        return $this->belongsTo('App\Model\Pengaturan\SatuanUnit', 'satuan_unit', 'id_satuan');
    }

    public function jenisNaskah()
    {
    	return $this->belongsTo('App\Model\Pengaturan\JenisNaskah', 'jenis_naskah', 'id_jenis_naskah');
    }

    public function get_tipe_registrasi()
    {
        if ($this->tipe_registrasi == '1') {
            return 'Naskah Masuk';
        }elseif($this->tipe_registrasi == '2') {
            return 'Memo';
        }elseif($this->tipe_registrasi == '3') {
            return 'Nota Dinas';
        }elseif($this->tipe_registrasi == '4') {
            return 'Naskah Keluar';
        }elseif($this->tipe_registrasi == '5') {
            return 'Naskah Tanpa Tindak Lanjut';
        }
    }

    public function get_tanggal_naskah()
    {
   		$tanggal = $this->tanggal_naskah;
   		return Carbon::parse($tanggal)->formatLocalized('%d %B %Y');
    }
}

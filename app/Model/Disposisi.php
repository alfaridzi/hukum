<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Disposisi extends Model
{
    protected $table = 'tbl_disposisi';
    protected $fillable = ['id_naskah', 'id_group', 'no_index', 'sifat', 'disposisi', 'updated_at'];
    protected $primaryKey = 'id_disposisi';
    // public $incrementing = false;

    public function naskah()
    {
    	return $this->belongsTo('App\Model\Naskah\Naskah', 'id_naskah', 'id_naskah');
    }

    public function get_disposisi()
    {
        return $this->where('id_naskah', $this->id_naskah)->where('id_group', $this->id_group)->get();
    }

    public function penerima()
    {
    	return $this->belongsTo('App\Model\Penerima', 'id_group', 'id_group');
    }

    public function sifatNaskah()
    {
    	return $this->belongsTo('App\Model\Pengaturan\SifatNaskah', 'id_sifat', 'sifat');
    }

    public function isiDisposisi()
    {
        if ($this->where('id_naskah', $this->id_naskah)->where('id_group', $this->id_group)->pluck('disposisi') == '[null]') {
            return '';
        }else{
            return str_replace('"]', '', str_replace('["', '', $this->belongsTo('App\Model\Pengaturan\isiDisposisi', 'disposisi', 'id_disposisi')->pluck('isi_disposisi')));
        }
    	
    }

    public function get_tanggal_disposisi()
    {
        $tanggal = $this->created_at;
        return Carbon::parse($tanggal)->formatLocalized('%d %B %Y');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class klasifikasi extends Model
{

	protected $table = 'tbl_klasifikasi';

	protected $fillable = ['kode','nama','deskripsi','rAktif','rInaktif','penyusutan_akhir','id_status','parent_id'];

    public function childs() {
        return $this->hasMany('App\klasifikasi','parent_id','id') ;
    }
}

<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class IsiDisposisi extends Model
{
    protected $table = 'tbl_isi_disposisi';
    protected $fillable = ['id_grup', 'isi_disposisi'];
    protected $primaryKey = 'id_disposisi';

    public function grup_jabatan()
    {
    	return $this->hasOne('App\Model\Pengaturan\GrupJabatan', 'id_grup', 'id_grup');
    }
}

<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class SifatNaskah extends Model
{
    protected $table = 'tbl_sifat_naskah';
    protected $fillable = ['sifat_naskah', 'updated_at'];
    protected $primaryKey = 'id_sifat_naskah';
}

<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class GrupJabatan extends Model
{
    protected $table = 'tbl_grup_jabatan';
    protected $fillable = ['nama_grup'];
    protected $primaryKey = 'id_grup';
}

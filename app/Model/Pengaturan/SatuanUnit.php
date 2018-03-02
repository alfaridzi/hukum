<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class SatuanUnit extends Model
{
    protected $table = 'tbl_satuan_unit';
    protected $fillable = ['nama_satuan'];
    protected $primaryKey = 'id_satuan';
}

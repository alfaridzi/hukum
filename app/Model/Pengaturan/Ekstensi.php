<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class Ekstensi extends Model
{
    protected $table = 'tbl_ekstensi';
    protected $fillable = ['jenis_ekstensi', 'updated_at'];
    protected $primaryKey = 'id_ekstensi';
}

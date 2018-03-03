<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class Perkembangan extends Model
{
    protected $table = 'tbl_perkembangan';
    protected $fillable = ['tingkat', 'updated_at'];
    protected $primaryKey = 'id_perkembangan';
}

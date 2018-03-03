<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class Urgensi extends Model
{
    protected $table = 'tbl_urgensi';
    protected $fillable = ['tingkat', 'updated_at'];
    protected $primaryKey = 'id_urgensi';
}

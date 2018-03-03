<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class Bahasa extends Model
{
    protected $table = 'tbl_bahasa';
    protected $fillable = ['bahasa', 'updated_at'];
    protected $primaryKey = 'id_bahasa';
}

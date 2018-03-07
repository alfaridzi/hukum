<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{
    protected $table = 'tbl_vital';
    protected $fillable = ['vital', 'updated_at'];
    protected $primaryKey = 'id_vital';
}

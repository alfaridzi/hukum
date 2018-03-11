<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'tbl_file';
    protected $fillable = ['id_naskah', 'id_group', 'nama_file', 'updated_at'];
    protected $primaryKey = 'id_file';
}

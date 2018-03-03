<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class JenisNaskah extends Model
{
	protected $table = 'tbl_jenis_naskah';
	protected $fillable = ['jenis_naskah', 'updated_at'];
	protected $primaryKey = 'id_jenis_naskah';
}

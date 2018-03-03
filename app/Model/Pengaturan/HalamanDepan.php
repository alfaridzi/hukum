<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class HalamanDepan extends Model
{
	protected $table = 'tbl_halaman_depan';
	protected $fillable = ['header_page', 'file_image', 'konten', 'updated_at'];
	protected $primaryKey = 'id_halaman';
}

<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class TextTombol extends Model
{
    protected $table = 'tbl_text_tombol';
    protected $fillable = ['keterangan', 'text', 'updated_at'];
    protected $primaryKey = 'id_button';
}

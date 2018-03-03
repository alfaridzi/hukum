<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class MediaArsip extends Model
{
    protected $table = 'tbl_media_arsip';
    protected $fillable = ['media_arsip', 'updated_at'];
    protected $primaryKey = 'id_media_arsip';
}

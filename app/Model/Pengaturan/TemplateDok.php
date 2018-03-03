<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;

class TemplateDok extends Model
{
    protected $table = 'tbl_template_dok';
    protected $fillable = ['nama_template', 'file_template', 'updated_at'];
    protected $primaryKey = 'id_template';
}

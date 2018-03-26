<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unitKerja extends Model
{
    public $fillable = ['title','parent_id','jabatan','id_grup','id_status'];
    protected $table = 'tbl_unitkerja';
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public $incrementing = false;
    
    public function childs() {
        return $this->hasMany('App\unitKerja','parent_id','id') ;
    }
}

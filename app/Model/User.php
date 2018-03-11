<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_user'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = ['id_user','id_jabatan','id_jabatan_atasan','id_status','username', 'nama', 'password', 'role', 'remember_token', 'updated_at',
    ];

    public function jabatan() {
        return $this->hasOne('App\unitKerja','id','id_jabatan') ;
    }

    public function get_role() {
        switch($this->role) {
            case 1:
            return 'Administrasi Pusat';
            break;

            case 2:
            return 'Administrasi Satuan Organisasi';
            brea;

            case 3:
            return 'Pejabat Struktural';
            break;

            case 4:
            return 'Sektretaris';
            break;

            case 5:
            return 'Pencatat Surat';
            break;

            default:
            return 'Error';
        }
    }

    public function getstatus() {
        if($this->id_status == '1') {
            echo "<i class='text-primary fa fa-2x fa-check'></i>";
        } else {
            echo "<i class='text-danger fa fa-2x fa-times'></i>";
        }
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = 'id_user';
}

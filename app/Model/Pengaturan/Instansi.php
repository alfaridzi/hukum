<?php

namespace App\Model\Pengaturan;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Instansi extends Model
{
      protected $table = 'tbl_instansi';
   	protected $fillable = ['kode_instansi', 'nama_instansi', 'nama_lain', 'tipe_instansi', 'tanggal_keberadaan', 'detail', 'mandat', 'status', 'updated_at'];
   	protected $primaryKey = 'id_instansi';

   	public function get_status()
   	{
   		if ($this->status == '1') {
   			return 'Aktif';
   		}elseif($this->status == '0'){
   			return 'Tidak Aktif';
   		}else{
   			return 'Tidak diketahui';
   		}
   	}

   	public function getTanggalKeberadaan()
   	{
   		$tanggal = $this->tanggal_keberadaan;
   		return Carbon::parse($tanggal)->format('m/d/Y');
   	}

   	public function getTanggalPerubahan()
   	{
   		$tanggal = $this->updated_at;
   		return Carbon::parse($tanggal)->formatLocalized('%d %B %Y %H:%M:%S');
   	}
}

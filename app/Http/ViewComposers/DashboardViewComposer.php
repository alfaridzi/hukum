<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Model\Naskah\Naskah;
use Auth;

class DashboardViewComposer {

	protected $count_naskah;

	public function __construct()
	{
        $user = Auth::user();
        if(!is_null($user)){
            $count_naskah = Naskah::whereNotIn('tipe_registrasi', ['5'])->whereHas('penerima', function($q) use($user){
            $q->whereHas('tujuan_kirim', function($q) use($user){
                $q->where('id_user', $user->id_user)->orWhere('id_jabatan', $user->id_jabatan);
            })->where('status_naskah', '0')->groupBy('id_group');
            })->count();
            $this->count_naskah = $count_naskah;
        }
	}

    public function compose(View $view) {
        $view->with('count_naskah', $this->count_naskah);
    }
}
?>
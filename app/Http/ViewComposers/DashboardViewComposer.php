<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Model\Naskah\Naskah;
use Auth;

class DashboardViewComposer {

	protected $user;
	protected $naskah;

	public function __construct()
	{
        $user = Auth::user();
        if(!is_null($user)){
            $naskah = Naskah::whereNotIn('tipe_registrasi', ['5'])->whereHas('penerima', function($q) use($user){
            $q->whereHas('tujuan_kirim', function($q) use($user){
                $q->where('id_user', $user->id_user)->orWhere('id_jabatan', $user->id_jabatan);
            })->where('status_naskah', '0')->orderBy('id_penerima', 'asc')->groupBy('id_naskah');
            })->with('urgensi')->with(['penerima' => function($q) use($user){
                $q->whereHas('tujuan_kirim', function($q) use($user){
                    $q->where('id_user', $user->id_user)->orWhere('id_jabatan', $user->id_jabatan);
                })->orderBy('id_penerima', 'asc')->groupBy('id_naskah');
            }])->orderBy('id_naskah', 'desc')->limit(3)->get();

            $this->user = $user;
            $this->naskah = $naskah;
        }
	}

    public function compose(View $view) {
        $view->with('gUser', $this->user)->with('naskahBaru', $this->naskah);
    }
}
?>
<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\GrupJabatan;
use App\Model\Pengaturan\IsiDisposisi;
use Carbon\Carbon;

class GrupJabatanController extends Controller
{
	public function index()
	{
		$grupJabatan = GrupJabatan::all();
		$no = 1;
		return view('pengaturan.grup_jabatan', compact('grupJabatan', 'no'));
	}

	public function tambah(Request $request)
	{
		$input = $request->all();

    	$validator = Validator::make($input, [
    		'nama_grup' => 'required|string'
    	]);

    	if ($validator->fails()) {
    		return redirect('pengaturan/grup-jabatan')
    					 ->withErrors($validator);
    	}

    	GrupJabatan::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data baru');
	}

	public function edit(Request $request)
	{
		$input = $request->all();
        $grupJabatan = GrupJabatan::findOrFail($input['id']);

    	$message = [
    		'id.required' => 'Terjadi suatu kesalahan',
    		'id.integer' => 'Terjadi suatu kesalahan',
    	];

    	$validator = Validator::make($input, [
    		'id' => 'required|integer',
    		'nama_grup' => 'required|string'
    	], $message);

    	if ($validator->fails()) {
    		return redirect('pengaturan/grup-jabatan')
    					 ->withErrors($validator);
    	}

    	$grupJabatan->update(['nama_grup' => $input['nama_grup'], 'updated_at' => Carbon::now()]);

    	return redirect()->back()->with('success', 'Berhasil update data');
	}

	public function delete($id)
    {
        if (is_null($id)) {
            return redirect()->back();
        }

        $grupJabatan = GrupJabatan::findOrFail($id);
        $grupJabatan->delete();

        $isiDisposisi = IsiDisposisi::where('id_grup', $id);

        if ($isiDisposisi) {
        	$isiDisposisi->delete();
        }

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

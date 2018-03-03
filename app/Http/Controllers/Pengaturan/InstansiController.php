<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pengaturan\Instansi;
use App\Http\Requests\Pengaturan\Instansi\TambahInstansiRequest;
use App\Http\Requests\Pengaturan\Instansi\EditInstansiRequest;
use Carbon\Carbon;

class InstansiController extends Controller
{
    public function index()
    {
    	$instansi = Instansi::all();
    	$no = 1;
    	return view('pengaturan.instansi.data_instansi', compact('instansi', 'no'));
    }

    public function tambah()
    {
    	return view('pengaturan.instansi.tambah_instansi');
    }

    public function simpan(TambahInstansiRequest $request)
    {
    	$input = $request->all();
    	$input['tanggal_keberadaan'] = Carbon::parse($input['tanggal_keberadaan'])->format('Y-m-d');

    	Instansi::create($input);
    	return redirect('pengaturan/instansi')->with('success', 'Berhasil menambahkan data baru');
    }

    public function edit($id)
    {
    	if (is_null($id)) {
    		return redirect()->back();
    	}

    	$instansi = Instansi::findOrFail($id);

    	return view('pengaturan.instansi.edit_instansi', compact('instansi'));
    }

    public function update(EditInstansiRequest $request, $id)
    {
    	$input = $request->all();
    	$input['tanggal_keberadaan'] = Carbon::parse($input['tanggal_keberadaan'])->format('Y-m-d');
        $input['updated_at'] = Carbon::now();

    	$instansi = Instansi::findOrFail($id);
    	$instansi->update($input);
    	
    	return redirect('pengaturan/instansi')->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	if (is_null($id)) {
    		return redirect()->back();
    	}

    	$instansi = Instansi::findOrFail($id);
    	$instansi->delete();
    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

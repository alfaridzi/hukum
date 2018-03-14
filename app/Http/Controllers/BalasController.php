<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Naskah\Naskah;
use App\Model\Penerima;
use App\Model\Files;
use App\Model\Disposisi;

use Validator;
use Auth;
use Storage;

class BalasController extends Controller
{
    public function teruskan(Request $request, $id)
    {
    	$naskah = Naskah::findOrFail($id);
        $penerima = Penerima::where('id_naskah', $id)->orderBy('id_penerima', 'desc')->first();
        $id_group = $penerima->id_group + 1;
    	$input = $request->all();
        $input['id_group'] = $id_group;
        $files = $request->file('file_uploads');
        $input['id_user'] = Auth::user()->id_user;
        $input['id_naskah'] = $naskah->id_naskah;
        $input['sebagai'] = 'to_forward';

        if (!is_null($files)) {
            foreach ($files as $key => $file) {
                $namaFile = substr(str_random(5).'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 30).'.'.$file->getClientOriginalExtension();
                $arrFiles[] = $namaFile;
                Storage::disk('uploads')->putFileAs('FilesUploaded/'.$naskah->file_dir.'/', $file, $namaFile);
                Files::create(['id_naskah' => $naskah->id_naskah, 'id_group' => $input['id_group'], 'nama_file' => $namaFile]);
            }
        }

        if (is_null($input['tembusan'])) {
            $tembusan = null;
        }else{
            $input['tembusan'] = explode(",", $input['tembusan']);
            $tembusan = $input['tembusan'];
        }

        if (is_null($input['kepada'])) {
            $data1 = null;
        }else{
            $input['kepada'] = explode(',', $input['kepada']);
            $data1 = $input['kepada'];
        }

        if (!is_null($data1)) {
            foreach ($data1 as $key => $data) {
                $input['kirim_user'] = $data;
                Penerima::create($input);
            }
        }
        $tembusan1['id_group'] = $id_group;
        $tembusan1['id_naskah'] = $naskah->id_naskah;
        $tembusan1['id_user'] = $input['id_user'];
        $tembusan1['pesan'] = $input['pesan'];
        if (!is_null($tembusan)) {
            foreach ($tembusan as $key => $data) {
                $tembusan1['sebagai'] = 'bcc';
                $tembusan1['kirim_user'] = $data;
                Penerima::create($tembusan1);
            }
        }

        return redirect()->back()->with('success', 'Berhasil meneruskan naskah');
    }

    public function balas(Request $request, $id)
    {
    	$naskah = Naskah::findOrFail($id);
        $penerima = Penerima::where('id_naskah', $id)->orderBy('id_penerima', 'desc')->first();
        $id_group = $penerima->id_group + 1;
    	$input = $request->all();
        $input['id_group'] = $id_group;
        $files = $request->file('file_uploads');
        $input['id_user'] = Auth::user()->id_user;
        $input['id_naskah'] = $naskah->id_naskah;

        if (!is_null($files)) {
            foreach ($files as $key => $file) {
                $namaFile = substr(str_random(5).'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 30).'.'.$file->getClientOriginalExtension();
                $arrFiles[] = $namaFile;
                Storage::disk('uploads')->putFileAs('FilesUploaded/'.$naskah->file_dir.'/', $file, $namaFile);
                Files::create(['id_naskah' => $naskah->id_naskah, 'id_group' => $input['id_group'], 'nama_file' => $namaFile]);
            }
        }

        if ($naskah->tipe_registrasi == 3) {
        	$input['sebagai'] = 'to_usul';
        }else{
        	$input['sebagai'] = 'to_reply';
        }
        if (is_null($input['tembusan'])) {
            $tembusan = null;
        }else{
            $input['tembusan'] = explode(",", $input['tembusan']);
            $tembusan = $input['tembusan'];
        }

        if (is_null($input['kepada'])) {
            $data1 = null;
        }else{
            $input['kepada'] = explode(',', $input['kepada']);
            $data1 = $input['kepada'];
        }

        if (!is_null($data1)) {
            foreach ($data1 as $key => $data) {
                $input['kirim_user'] = $data;
                Penerima::create($input);
            }
        }
        $tembusan1['id_group'] = $id_group;
        $tembusan1['id_naskah'] = $naskah->id_naskah;
        $tembusan1['id_user'] = $input['id_user'];
        $tembusan1['pesan'] = $input['pesan'];
        if (!is_null($tembusan)) {
            foreach ($tembusan as $key => $data) {
                $tembusan1['sebagai'] = 'bcc';
                $tembusan1['kirim_user'] = $data;
                Penerima::create($tembusan1);
            }
        }

        return redirect()->back()->with('success', 'Berhasil membalas naskah');
    }

    public function disposisi(Request $request, $id)
    {
        $input = $request->all();

        $messages = [
            'kepada.required' => 'Bidang isian tujuan wajib diisi.',
        ];

        $validator = Validator::make($input, [
            'kepada' => 'required',
            'disposisi' => 'nullable',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$naskah = Naskah::findOrFail($id);
        $penerima = Penerima::where('id_naskah', $id)->orderBy('id_penerima', 'desc')->first();
        $id_group = $penerima->id_group + 1;
    	
        $input['id_group'] = $id_group;
        $files = $request->file('file_uploads');
        $input['id_user'] = Auth::user()->id_user;
        $input['id_naskah'] = $naskah->id_naskah;
        $input['sebagai'] = 'cc1';

        if (!isset($input['disposisi'])) {
            $input['disposisi'] = null;
        }

        if (!is_null($files)) {
            foreach ($files as $key => $file) {
                $namaFile = substr(str_random(5).'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 30).'.'.$file->getClientOriginalExtension();
                $arrFiles[] = $namaFile;
                Storage::disk('uploads')->putFileAs('FilesUploaded/'.$naskah->file_dir.'/', $file, $namaFile);
                Files::create(['id_naskah' => $naskah->id_naskah, 'id_group' => $input['id_group'], 'nama_file' => $namaFile]);
            }
        }

        if (!is_null($input['disposisi'])) {
            foreach ($input['disposisi'] as $key => $data) {
                $input['disposisi'] = $data;
                Disposisi::create($input);
            }
        }

		if (is_null($input['kepada'])) {
            $data1 = null;
        }else{
            $input['kepada'] = explode(',', $input['kepada']);
            $data1 = $input['kepada'];
        }
		if (!is_null($data1)) {
            foreach ($data1 as $key => $data) {
                $input['kirim_user'] = $data;
                Penerima::create($input);
            }
        }
    	
    	return redirect()->back()->with('success', 'Berhasil mengirim disposisi');
    }

    public function cetakDisposisi($id, $id_group)
    {
        $penerima = Penerima::where('id_naskah', $id)->where('id_group', $id_group)->with(['disposisi' => function($q) use($id, $id_group){
            $q->where('id_naskah', $id)->where('id_group', $id_group)->groupBy('id_group');
        }])->with('naskah')->with('user', 'tujuan_kirim')->groupBy('id_group')->first();
        return view('cetak_disposisi', compact('penerima'));
    }
}

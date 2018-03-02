<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use App\Model\Pengaturan\HalamanDepan;
use Validator;
use File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class HalamanDepanController extends Controller
{
    public function index()
    {
    	$halamanDepan = HalamanDepan::first();
    	return view('pengaturan.halaman_depan', compact('halamanDepan'));
    }

    public function edit(Request $request)
    {
    	$input = $request->all();
    	$halamanDepan = HalamanDepan::first();
    	
    	$message = [
    		'header_page.required' => 'Field Judul Halaman dibutuhkan',
    		'header_page.string' => 'Field Judul Halaman harus berupa string',
    		'header_page.max' => 'Field Judul Halaman tidak boleh lebih dari 150 karakter',
    		'konten.required' => 'Field Konten dibutuhkan',
    		'konten.string' => 'Field Konten harus berupa string',
    		'file_image.required' => 'Field Satuan Unit dibutuhkan',
    		'file_image.string' => 'Field File Image harus berupa gambar',
    		'file_image.mimes' => 'Ekstensi file yang diperboleh hanya jpeg, jpg dan png'
    	];

    	$validator = Validator::make($input, [
    		'header_page' => 'required|string|max:150',
    		'konten' => 'required|string',
    		'file_image' => 'required|image|mimes:jpeg,jpg,png'
    	], $message);

    	if ($validator->fails()) {
    		return redirect('pengaturan/halaman-depan')
    					 ->withErrors($validator);
    	}

    	if (!is_null($request->file('file_image'))) {
            $file_image = $request->file('file_image');
            if (File::exists('assets/images/uploads/halaman_depan/'.$halamanDepan->file_image)) {
                File::delete('assets/images/uploads/halaman_depan/'.$halamanDepan->file_image);
            }
            $ekstensi = $file_image->getClientOriginalExtension();
            $namaFile = substr(str_random(5).'-'.pathinfo($file_image->getClientOriginalName(), PATHINFO_FILENAME), 0, 30).'.'.$ekstensi;
            $file_image->move('assets/images/uploads/halaman_depan/', $namaFile);

            $halamanDepan->update(['header_page' => $input['header_page'], 'file_image' => $namaFile, 'konten' => $input['konten']]);
        }

        $halamanDepan->update(['header_page' => $input['header_page'], 'konten' => $input['konten']]);

    	return redirect()->back()->with('success', 'Berhasil update halaman');
    }
}

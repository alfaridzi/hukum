<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\klasifikasi;

class klasifikasiController extends Controller
{
    public function klasifikasi()
    {
        $klasifikasi = klasifikasi::where('parent_id', '=', 0)->get();
        return view('klasifikasi',compact('klasifikasi'));
    }


    public function tambahKlasifikasi(Request $request)
    {
        $this->validate($request, [
        		'nama' => 'required',
        	]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        
        klasifikasi::create($input);
        return back()->with('success', 'New Classification added successfully.');
    }

     public function deleteData($id) {
    	$klasifikasi = klasifikasi::find($id);
    	if($klasifikasi->childs()->count() > 0) {
    		$klasifikasi->childs()->delete();
    	}
    	$klasifikasi->delete();
    	return back()->with('success', ' Classification Has been deleted.');
    }



    public function updateKlasifikasi(Request $request, $id)
    {
        $this->validate($request, [
        		'nama' => 'required',
        	]);

        $unit = klasifikasi::findOrFail($id);


        $input = $request->all();
       	if($request->get('id_status') == '') {
       		$input['id_status'] = '0';
       	}
        $unit->update($input);
        $unit->save();
        return back()->with('success', 'Classification updated successfully.');
    }


}

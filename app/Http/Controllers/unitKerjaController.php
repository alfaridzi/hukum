<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\unitKerja;
use App\Model\Pengaturan\GrupJabatan;

class unitKerjaController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function unitKerja()
    {
        $unitKerja = unitKerja::where('parent_id', '=', 0)->get();
       
        $grupjabatan = GrupJabatan::pluck('nama_grup', 'id_grup')->all();


        return view('categoryTreeview',compact('unitKerja','grupjabatan'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahUnitKerja(Request $request)
    {
        $this->validate($request, [
        		'title' => 'required',
        	]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        
        unitKerja::create($input);
        return back()->with('success', 'New Unit added successfully.');
    }



    public function updateUnitKerja(Request $request, $id)
    {
        $this->validate($request, [
        		'title' => 'required',
        	]);

        $unit = unitKerja::findOrFail($id);
        $input = $request->all();
        $unit->update($input);
        $unit->save();
        return back()->with('success', 'New Unit added successfully.');
    }

    public function deleteData($id) {
    	unitKerja::find($id)->delete();
    	return back()->with('success', ' Unit Has been deleted.');
    }


}
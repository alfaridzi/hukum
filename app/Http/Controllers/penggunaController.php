<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\unitKerja;
use Hash;
use Validator;

class penggunaController extends Controller
{
    public function index()
    {
    	$user = user::all();
    	$unitKerja = unitKerja::where('parent_id', '=', 'root')->get();
    	$unit = unitKerja::all();
    	$no = 1;
    	return view('user.index', compact('user', 'no','unitKerja','unit'));
    }

    public function tambah(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
    		'password' => 'required|confirmed',
    	]);

    	if ($validator->fails()) {
    		return redirect('/pengguna')
    					->withErrors($validator);
    	}

    	$input['password'] = Hash::make($input['password']);
    	User::create($input);

    	return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function edit(Request $request)
    {
    	$input = $request->all();

    	//$messages = [
    	//	'id.required' => 'Terjadi suatu kesalahan',
    	//	'id.integer' => 'Terjadi suatu kesalahan'
    	//];

    	//$validator = Validator::make($input, [
    	//	'id'	 => 'required|integer',
    	//	'bahasa' => 'required|string|max:40',
    	//], $messages);

    	//if ($validator->fails()) {
    	//	return redirect('pengaturan/bahasa')
    	//				->withErrors($validator);
    	//}
      //  $input['updated_at'] = Carbon::now();

    	


    	
    	$user = User::findOrFail($input['id_user']);
    	$passwd = $user->password;

    	
    	if(!isset($input['id_status'])) {
    		$input['id_status'] = '0';
    	}

    	if(!is_null($input['password'])) {
    		$validator = Validator::make($input, [
    			'password' => 'required|confirmed',
    		]);

	    	if ($validator->fails()) {
	    		return redirect('/pengguna')
	    					->withErrors($validator);
	    	}

    		$input['password'] = Hash::make($input['password']);

    	} else {
    		$input['password'] = $passwd;
    	}



    	$user->update($input);

    	return redirect()->back()->with('success', 'Berhasil update data');
    }

    public function delete($id)
    {
    	$user = user::findOrFail($id)->delete();

    	return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}

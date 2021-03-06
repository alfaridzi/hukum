<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Model\User;
use App\Model\Pengaturan\HalamanDepan;

class LoginController extends Controller
{
    public function index()
    {
        $halamanDepan = HalamanDepan::first();
    	return view('login', compact('halamanDepan'));
    }

    public function login(Request $request)
    {
    	$input = $request->all();

    	if (Auth::attempt(['username' => $input['username'], 'password' => $input['password']])) {
    		return redirect()->intended('/dashboard');
    	}else{
            return redirect()->back()->withErrors('Username atau password anda salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil Logout');
    }
}

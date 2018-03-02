<?php

namespace App\Http\Controllers\Pengaturan;

use Illuminate\Http\Request;
use App\Model\Pengaturan\HalamanDepan;
use App\Http\Controllers\Controller;

class HalamanDepanController extends Controller
{
    public function index()
    {
    	$halamanDepan = HalamanDepan::first();
    	return view('pengaturan.halaman_depan', compact('halamanDepan'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(){
        $siswa = DB::table('karyawan')->orderBy('nama_lengkap')
        // ->join()
        ->get();
        return view('siswa.index',compact('siswa'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(Request $request){

        $query = Karyawan::query();
        $query->select('karyawan.*', 'jabatan');
        $query->join('kelas', 'karyawan.kode_kelas', '=', 'kelas.kode_kelas');
        $query->orderBy('nama_lengkap');
        if(!empty($request->nama_siswa )){
            $query->where('nama_lengkap', 'like', '%' . $request->nama_siswa . '%');
        }

        if(!empty($request->kelas )){
            $query->where('karyawan.kode_kelas', $request->kelas );
        }
        $karyawan = $query->paginate(2);
        // $siswa = DB::table('karyawan')->orderBy('nama_lengkap')
        // // ->join()
        // ->paginate(2);
        // dd($request->all());

        $kelas = DB::table('kelas')->get();
        return view('siswa.index',compact('karyawan','kelas'));
    }
}

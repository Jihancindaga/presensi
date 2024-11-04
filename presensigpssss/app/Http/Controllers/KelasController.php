<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $nama_kelas = $request->nama_kelas;
        $query = Kelas::query();
        $query->select('*');
        if (!empty($nama_kelas)) {
            $query->where('nama_kelas', 'like', '%' . $nama_kelas . '%');
        }
        $kelas = $query->get();
        // $kelas = DB::table('kelas')->orderBy('kode_kelas')->get();
        return view('kelas.index', compact('kelas'));
    }


    public function store(Request $request)
    {
        $kode_kelas = $request->kode_kelas;
        $nama_kelas = $request->nama_kelas;
        $data = [
            'kode_kelas' => $kode_kelas,
            'nama_kelas' => $nama_kelas
        ];

        $simpan = DB::table('kelas')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }


    public function edit(Request $request)
    {
        $kode_kelas = $request->kode_kelas;
        $kelas = DB::table('kelas')->where('kode_kelas', $kode_kelas)->first();
        return view('kelas.edit', compact('kelas'));
    }


    public function update($kode_kelas, Request $request)
    {
        $nama_kelas = $request->nama_kelas;
        $data = [
            'nama_kelas' => $nama_kelas
        ];

        $update = DB::table('kelas')->where('kode_kelas', $kode_kelas)->update($data);
        if($update){
            return Redirect::back()->with(['success'=>'Data Berhasil Di update']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Di update']);
        }
    }


    public function delete($kode_kelas)
    {
        $hapus = DB::table('kelas')->where('kode_kelas', $kode_kelas)->delete();
        if($hapus) {
            return Redirect::back()->with(['success'=>'Data Berhasil Di Hapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Di Hapus']);
        }
        
    }
}

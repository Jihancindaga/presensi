<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Egulias\EmailValidator\Warning\DeprecatedComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
        $karyawan = $query->paginate(10);


        $kelas = DB::table('kelas')->get();
        return view('siswa.index',compact('karyawan','kelas'));
    }

    public function store(Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_kelas =$request->kode_kelas;
        $password = Hash::make('123');
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto ?? 'default.png';
        }

        try {
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_kelas' => $kode_kelas,
                'foto' => $foto,
                'password' => $password
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath = "uploads/karyawan";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }

                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return Redirect::back()->with(['error' => 'Data Gagal Disimpan']);

        }
    }

    public function edit(Request $request)
    {
        $nik = $request->nik;
        // $departemen = DB::table('departemen')->get();
        return view('siswa.edit');
    }


}

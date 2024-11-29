<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Karyawan;
use Egulias\EmailValidator\Warning\DeprecatedComment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
// use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    public function index(Request $request){
        $query = Karyawan::query();
        $query->select('karyawan.*', 'jabatan');
        $query->join('kelas', 'karyawan.kode_kelas', '=', 'kelas.kode_kelas');
        $query->orderBy('nama_lengkap');
        // if(!empty($request->nama_siswa )){
        //     $query->where('nama_lengkap', 'like', '%' . $request->nama_siswa . '%');
        // }

        // if(!empty($request->kelas )){
        //     $query->where('karyawan.kode_kelas', $request->kelas );
        // }
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
        // $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
            // $foto = $karyawan->foto ?? 'default.png';
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
                    $folderPath = "public/uploads/karyawan/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }

                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            if($e->getCode()==23000){
                $message = "Data dengan NIS " . $nik . " Sudah Ada";
            };
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan' . $message]);

        }
    }

    public function edit(Request $request)
    {
        $nik = $request->nik;
        $kelas = DB::table('kelas')->get();
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('siswa.edit',compact('kelas','karyawan'));
    }

    public function update($nik, Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_kelas =$request->kode_kelas;
        $password = Hash::make('123');
        $old_foto = $request->old_foto;
        // $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_kelas' => $kode_kelas,
                'foto' => $foto,
                'password' => $password
            ];
            $update = DB::table('karyawan')->where('nik', $nik)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/karyawan/";
                    $folderPathOld = "public/uploads/karyawan/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }

                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return Redirect::back()->with(['error' => 'Data Gagal Diupdate']);

        }
    }

    public function delete($nik){
        $delete = DB::table('karyawan')->where('nik',$nik)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);

        }
    }

    // public function importexcel(Request $request){
    //     $data = $request->file('file');

    //     $namafile =$data->getClientOriginalName();
    //     $data->move('DataSiswa', $namafile);

    //     Excel::import(new SiswaImport, public_path('DataSiswa/'. $namafile));
    //     return redirect()->back();
    // }

}

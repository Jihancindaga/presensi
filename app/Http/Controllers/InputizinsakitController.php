<?php

namespace App\Http\Controllers;

use App\Models\Inputizinsakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class InputizinsakitController extends Controller
{
    public function izinsakit()
    {
        // $query = Inputizinsakit::query();
        // $query->select('id','tgl_izin','pengajuan_izin.nik','nama_lengkap','kode_kelas','status','status_approved','keterangan');
        // $query->join('karyawan','pengajuan_izin.nik','=','karyawan.nik');
        $inputizin = DB::table('input_izin')->orderBy('nisn')
        ->join('kelas','input_izin.kode_kelas', '=', 'kelas.kode_kelas')
        ->join('karyawan','input_izin.nisn','=','karyawan.nik')
        ->get();
        $kelas = DB::table('kelas')->get();
        return view('presensi.inputizinsakit', compact('inputizin','kelas'));
    }

    public function storeizinsakit(Request $request)
    {
        $nisn = $request->nisn;
        $tanggal_izin = $request->tanggal_izin;
        $nama_lengkap = $request->nama_lengkap;
        $kode_kelas = $request->kode_kelas;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nisn' => $nisn,
            'tanggal_izin' => $tanggal_izin,
            'nama_lengkap' => $nama_lengkap,
            'kode_kelas' => $kode_kelas,
            'status' => $status,
            'keterangan' => $keterangan
        ];
        try {
            DB::table('input_izin')->insert($data);
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);

        }
    }

    public function editizinsakit(Request $request){
        $nisn = $request->nisn;
        $input_izin = DB::table('input_izin')->where('nisn', $nisn)->first();
        return view('presensi.editinputizinsakit',compact('input_izin'));
    }

    public function updateizinsakit(Request $request)
    {
        $nisn = $request->nisn;
        $tanggal_izin = $request->tanggal_izin;
        $nama_lengkap = $request->nama_lengkap;
        $kode_kelas = $request->kode_kelas;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'tanggal_izin' => $tanggal_izin,
            'nama_lengkap' => $nama_lengkap,
            'kode_kelas' => $kode_kelas,
            'status' => $status,
            'keterangan' => $keterangan
        ];
        try {
            DB::table('input_izin')->where('nisn', $nisn)->update($data);
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);

        }
    }

    public function deleteizinsakit($nisn)
    {
        $hapus = DB::table('input_izin')->where('nisn', $nisn)->delete();
        if($hapus) {
            return Redirect::back()->with(['success'=>'Data Berhasil Di Hapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Di Hapus']);
        }
        
    }
}

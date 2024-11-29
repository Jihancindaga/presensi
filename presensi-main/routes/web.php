<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin',[AuthController::class,'proseslogin']);
});

Route::middleware(['guest:user'])->group(function(){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin',[AuthController::class,'prosesloginadmin']);
});

Route::middleware(['auth:karyawan'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout',[AuthController::class,'proseslogout']);

    //presensi
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    //edit profile
    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile',[PresensiController::class,'updateprofile']);

    //histori
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    //izin 
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);

});

Route::middleware(['auth:user'])->group(function(){
    Route::get('/proseslogoutadmin',[AuthController::class,'proseslogoutadmin']);
    Route::get('/panel/dashboardadmin',[DashboardController::class,'dashboardadminboostrap']);


    //siswa
    Route::get('/siswa',[KaryawanController::class,'index']);
    Route::post('/siswa/store',[KaryawanController::class,'store']);
    Route::post('/siswa/edit',[KaryawanController::class,'edit']);
    Route::post('/siswa/{nik}/update',[KaryawanController::class,'update']);
    Route::post('/siswa/{nik}/delete',[KaryawanController::class,'delete']);
    Route::post('/siswa/importexcel',[KaryawanController::class,'importexcel']);



    // kelas
    Route::get('/kelas', [KelasController::class,'index']);
    Route::post('/kelas/store', [KelasController::class,'store']);
    Route::post('/kelas/edit', [KelasController::class,'edit']);
    Route::post('/kelas/{kode_kelas}/update', [KelasController::class,'update']);
    Route::post('/kelas/{kode_kelas}/delete', [KelasController::class,'delete']);


    //presensi
    Route::get('/presensi/monitoring', [PresensiController::class,'monitoring']);
    Route::post('/getpresensi', [PresensiController::class,'getpresensi']);
    Route::post('/tampilkanpeta', [PresensiController::class,'tampilkanpeta']);
    Route::get('/presensi/laporan', [PresensiController::class,'laporan']);
    Route::post('/presensi/cetaklaporan', [PresensiController::class,'cetaklaporan']);
    Route::get('/presensi/rekap', [PresensiController::class,'rekap']);
    Route::post('/presensi/cetakrekap', [PresensiController::class,'cetakrekap']);
    Route::get('/presensi/izinsakit', [PresensiController::class, 'izinsakit']);
    Route::post('/presensi/approveizinsakit', [PresensiController::class, 'approveizinsakit']);
    Route::get('/presensi/{id}/batalkanizinsakit', [presensiController::class, 'batalkanizinsakit']);
    

    // Konfigurasi

    Route::get('/konfigurasi/lokasisekolah',[KonfigurasiController::class,'lokasisekolah']);
    Route::post('/konfigurasi/updatelokasisekolah',[KonfigurasiController::class,'updatelokasisekolah']);
});




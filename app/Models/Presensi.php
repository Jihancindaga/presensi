<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    // Tambahkan properti atau metode lain yang diperlukan di sini
    protected $table = "presensi";
   protected $primaryKey ="nik";
    // protected $fillable = [
    //     'nik',
    //     'nama_lengkap',
    //     'jabatan',
    //     'no_hp',
    //     'kelas',
    //     'password',
    // ];

   
}

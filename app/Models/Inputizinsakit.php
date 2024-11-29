<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inputizinsakit extends Model
{
    use HasFactory;

    protected $table = 'input_izin'; // Nama tabel
    protected $fillable = ['nisn', 'tanggal_izin', 'nama_lengkap', 'kode_kelas','status', 'keterangan'];
}
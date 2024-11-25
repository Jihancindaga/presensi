<?php

namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Karyawan([
        //         'nik' => $row[0],
        //         'nama_lengkap' => $row[1],
        //         'jabatan' => $row[2],
        //         'no_hp' => $row[3],
        //         'foto' => $row[4],
        //         'kode_kelas' => $row[5],
        //         'password'      => bcrypt('default_password') 
        // ]);
        // dd($row); 

        // Cek apakah array memiliki cukup elemen
    if (!isset($row[1]) || !isset($row[2]) || !isset($row[3]) || !isset($row[4])) {
        // Log data yang bermasalah
        logger('Baris tidak valid: ' . json_encode($row));
        return null; // Abaikan baris yang tidak valid
    }

    return new Karyawan([
        'nik'           => $row[0] ?? null,
        'nama_lengkap'  => $row[1] ?? null,
        'jabatan'       => $row[2] ?? null,
        'no_hp'         => $row[3] ?? null,
        'foto'          => $row[4] ?? null,
        'kode_kelas'    => $row[5] ?? 'Default_Kelas', // Atur default jika kosong
        'password'      => bcrypt('default_password'), // Default password
    ]);

    }
    
    
}

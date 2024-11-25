<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  @page { size: A4 }

  #title{
    font-size: 16px;
    font-weight: bold;
  }
  .tabeldatasiswa{
    margin-top: 40px;
  }
  .tabeldatasiswa td{
    padding: 5px;
  }
  .tabeldatasiswa img {
        width: auto; /* Atur lebar sesuai keinginan, misalnya 100px */
        height: 100px; /* Agar tinggi gambar mengikuti proporsi aslinya */
    }
    .tabelpresensi{
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    .tabelpresensi tr th{
        border: 1px solid black;
        padding: 8px;
        background-color: lightgrey;
    }
    .tabelpresensi tr td{
        border: 1px solid black;
        padding: 5px;
        font-size: 12px;
    }
    .foto{
        width: 50px; /* Atur lebar sesuai keinginan, misalnya 100px */
        height: 40px;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
    <?php
    function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        };
    ?>

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%">
        <tr>
            <td style="width: 30px"> 
                <img src="{{ asset('assets/img/logo-smadaba.png')}}" width="80" height="80" alt="">
            </td>
            <td>
                <span id="title">SMA N 2 BANTUL <br>
                    PERIODE {{ strtoupper($namabulan[$bulan])}} {{ $tahun}} <br>
                </span>
                <span> <i>Jl. Ra. Kartini, Trirenggo, Kec. Bantul, Bantul, Daerah Istimewa Yogyakarta 55714, Indonesia. Telepon: (0274) 367309 </i> </span>
            </td>
        </tr>
    </table>
    <table class="tabeldatasiswa" >
        <tr>
            {{-- <td rowspan="6">
                @php
                    $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
                @endphp
                <img src="{{ url($path)}}" alt="">
            </td> --}}
        </tr>
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td>{{ $karyawan->nik}}</td>
        </tr>
        <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td>{{ $karyawan->nama_lengkap}}</td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>:</td>
            <td>{{ $karyawan->jabatan}}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>{{ $karyawan->kode_kelas}}</td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td>:</td>
            <td>{{ $karyawan->no_hp}}</td>
        </tr>
    </table>
    <table class="tabelpresensi">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            @foreach ($presensi as $d)
                @php

                    $jamterlambat = selisih('07:00:00', $d->jam_in);
                    // $path_in = asset('storage/uploads/absensi/' . $d->foto_in);
                    // $path_out = asset('storage/uploads/absensi/' . $d->foto_out);

                @endphp
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ date("d-m-Y", strtotime($d->tgl_presensi))}}</td>
                    <td>{{ $d->jam_in }}</td>
                    {{-- <td>{{ $d->foto_in}}</td> --}}
                    <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Presensi' }}</td>
                   
                    <td>
                        @if ($d->jam_in > '07:00')
                        Terlambat {{ $jamterlambat}}
                        @else
                        Tepat Waktu
                        @endif
                    </td>
                </tr>
            @endforeach
        </tr>
    </table>

    <table width="100%" style="margin-top: 100px">
        <tr>
            <td colspan="2" style="text-align: right">Bantul, {{ date('d-m-Y')}}</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align:bottom" height="100px">
                <u>Shinta Putri Ramadhani</u><br>
                <i><b>Guru Wali Kelas</b></i>
            </td>
            <td style="text-align: center; vertical-align:bottom" >
                <u>Firma Zulfia</u><br>
                <i><b>Guru BK</b></i>
            </td>
        </tr>
    </table>
  </section>

</body>

</html>
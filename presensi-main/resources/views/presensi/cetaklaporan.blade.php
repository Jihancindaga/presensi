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
    @php
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

        $totalsakit = 0;
        $totalalpha = 0;
        $totalizin = 0;
        $totalhadir = 0;
        $totalterlambat = 0;
    @endphp

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
            <td rowspan="6">
                @php
                    $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
                @endphp
                <img src="{{ url($path)}}" alt="">
            </td>
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
        <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Foto In</th>
            <th>Jam Pulang</th>
            <th>Foto Out</th>
            <th>Keterangan</th>
        </tr>
        </thead>
       
        <tbody>
        @foreach ($presensi as $d)
                @php
                    $path_in = Storage::url('uploads/absensi/'.$d->foto_in);
                    $path_out = Storage::url('uploads/absensi/'.$d->foto_out);
                    $jamterlambat = selisih('07:00:00', $d->jam_in);
                    // $path_in = asset('storage/uploads/absensi/' . $d->foto_in);
                    // $path_out = asset('storage/uploads/absensi/' . $d->foto_out);

                    if ($d->keterangan == 'Sakit') $totalsakit++;
                    elseif ($d->keterangan == 'Alpha') $totalalpha++;
                    elseif ($d->keterangan == 'Izin') $totalizin++;
                    elseif (!empty($d->jam_in)) {
                    $totalhadir++;
                    if ($d->jam_in > '07:00:00') $totalterlambat++;
                    }
                @endphp
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ date("d-m-Y", strtotime($d->tgl_presensi))}}</td>
                    <td>{{ $d->jam_in }}</td>
                    {{-- <td>{{ $d->foto_in}}</td> --}}
                    <td><img src="{{ url($path_in)}}" alt="" class="foto"></td>
                    <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Presensi' }}</td>
                    <td>
                        @if ($d->jam_out != null)
                        <img src="{{ url($path_out)}}" alt="" class="foto"></td>
                        @else
                            No Photo
                        @endif
                    </td>
                    <td> {{ $d->keterangan }} 
                        <!-- @if ($d->jam_in > '07:00')
                        Terlambat {{ $jamterlambat}}
                        @else
                        Tepat Waktu
                        @endif -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals" style="margin-top: 20px; width: 50%; border-collapse: collapse;">
  <tr>
    <td style="border: 1px solid black; padding: 5px;"><strong>Jumlah Sakit:</strong></td>
    <td style="border: 1px solid black; padding: 5px;">{{ $totalsakit }}</td>
  </tr>
  <tr>
    <td style="border: 1px solid black; padding: 5px;"><strong>Jumlah Alpha:</strong></td>
    <td style="border: 1px solid black; padding: 5px;">{{ $totalalpha }}</td>
  </tr>
  <tr>
    <td style="border: 1px solid black; padding: 5px;"><strong>Jumlah Izin:</strong></td>
    <td style="border: 1px solid black; padding: 5px;">{{ $totalizin }}</td>
  </tr>
  <tr>
    <td style="border: 1px solid black; padding: 5px;"><strong>Total Hadir:</strong></td>
    <td style="border: 1px solid black; padding: 5px;">{{ $totalhadir }}</td>
  </tr>
  <tr>
    <td style="border: 1px solid black; padding: 5px;"><strong>Total Terlambat:</strong></td>
    <td style="border: 1px solid black; padding: 5px;">{{ $totalterlambat }}</td>
  </tr>
</table>

    <!-- <table class="totals">
      <tr>
        <td><strong>Jumlah Sakit:</strong> {{ $totalsakit }}</td>
        <td><strong>Jumlah Alpha:</strong> {{ $totalalpha }}</td>
        <td><strong>Jumlah Izin:</strong> {{ $totalizin }}</td>
        <td><strong>Total Hadir:</strong> {{ $totalhadir }}</td>
        <td><strong>Total Terlambat:</strong> {{ $totalterlambat }}</td>
      </tr>
    </table> -->

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
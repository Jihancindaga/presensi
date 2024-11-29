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
        font-size: 10px;
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
<body class="A4 landscape">
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
                <span id="title">
                    REKAP PRESENSI SISWA <br>
                    SMA N 2 BANTUL <br>
                    PERIODE {{ strtoupper($namabulan[$bulan])}} {{ $tahun}} <br>
                </span>
                <span> <i>Jl. Ra. Kartini, Trirenggo, Kec. Bantul, Bantul, Daerah Istimewa Yogyakarta 55714, Indonesia. Telepon: (0274) 367309 </i> </span>
            </td>
        </tr>
    </table>

    <table class="tabelpresensi">
    <tr>
        <th rowspan="2">NIK</th>
        <th rowspan="2">Nama Siswa</th>
        <th colspan="31">Tanggal</th>
        <th rowspan="2">A</th>
        <th rowspan="2">S</th>
        <th rowspan="2">I</th>
        <th rowspan="2">TH</th>
        <th rowspan="2">TT</th>
    </tr>
    
    <tr>
        @for ($i = 1; $i <= 31; $i++)
            <th>{{ $i }}</th>
        @endfor
    </tr>

    @foreach ($rekap as $d)
        @php
            $totalhadir = 0;
            $totalterlambat = 0;
            $totalsakit = 0;
            $totalizin = 0;
            $totalalpha = 0;
        @endphp
        <tr>
            <td>{{ $d->nik }}</td>
            <td>{{ $d->nama_lengkap }}</td>

            @for ($i = 1; $i <= 31; $i++)
    @php
        $tgl = "tgl_" . $i;
        $hadir = isset($d->$tgl) ? explode("-", $d->$tgl) : ['', ''];

        if ($hadir[0] == "S") {
            $totalsakit++;
        } elseif ($hadir[0] == "A") {
            $totalalpha++;
        } elseif ($hadir[0] == "I") {
            $totalizin++;
        } elseif (!empty($hadir[0])) {
            $totalhadir++;
            if (isset($hadir[0]) && $hadir[0] > "07:00:00") {
                $totalterlambat++;
            }
        }
    @endphp

    <td>
        <span style="color: {{ isset($hadir[0]) && $hadir[0] > '07:00:00' ? 'red' : '' }}">
            {{ $hadir[0] ?? '' }}
        </span><br>
        <span style="color: {{ isset($hadir[1]) && $hadir[1] < '16:00:00' ? 'red' : '' }}">
            {{ $hadir[1] ?? '' }}
        </span>
    </td>
@endfor


            <td>{{ $totalalpha }}</td>
            <td>{{ $totalsakit }}</td>
            <td>{{ $totalizin }}</td>
            <td>{{ $totalhadir }}</td>
            <td>{{ $totalterlambat }}</td>
        </tr>
    @endforeach
</table>

    <table width="100%" style="margin-top: 100px">
        <tr>
            <td></td>
            <td  style="text-align: center">Bantul, {{ date('d-m-Y')}}</td>
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
<?php

namespace App\Http\Controllers;

use App\Models\InputIzin;
use App\Models\Karyawan;
use App\Models\Kelas;
use App\Models\Presensi;
use Illuminate\Support\Facades\Log;
use App\Models\Pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class PresensiController extends Controller
{
    // Fungsi untuk mengirim pesan WhatsApp menggunakan Fonnte
    public function kirimPesanWhatsAppFonnte($to, $message)
    {
        $apiKey = '5Vim9REMBLrHC8cKvjGA';  // Ganti dengan API Key Fonnte Anda
        
        // Kirim request ke API Fonnte
        $response = Http::withHeaders([
            'Authorization' => $apiKey
        ])->post('https://api.fonnte.com/send', [
            'target' => $to,
            'message' => $message,
            'delay' => 2, // delay dalam detik
            'countryCode' => '62' // kode negara, 62 untuk Indonesia
        ]);
        Log::info('Fonnte API Response: ' . $response->body());

        // return $response->json();
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lok_sekolah = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        $lok = explode(",", $lok_sekolah->lokasi_sekolah);
        $latitudekantor = $lok[0]; 
        $longitudekantor = $lok[1];
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];

        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();

        $ket = $cek > 0 ? "out" : "in"; // Jika sudah ada presensi maka "out", jika belum "in"

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nik . "-" . $tgl_presensi . "-" . $ket; 
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        $datasiswa = DB::table('karyawan')->where('nik', $nik)->first();
        $no_hp = $datasiswa->no_hp;

        if ($radius > $lok_sekolah->radius) {
            echo "error|Maaf Anda Berada diluar Radius, Jarak Anda " . $radius . " meter dari Sekolah|";
        } else {
            if ($cek > 0) {
                // Presensi pulang
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' => $lokasi
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if ($update) {
                    echo "success|Terimakasih, Hati-hati di jalan|out";
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://localhost:8000/wagateway.pedasalamai.com/send-massage',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('message' => 'Terimakasih anda sudah presensi pulang, Anak anda melakukan presensi pulang di jam ' . $jam ,'number' => '085712911758','file_dikirim'=> ''),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    echo $response;
                    Storage::put($file, $image_base64);

                    // Kirim notifikasi ke orang tua saat presensi pulang
                    // $nomorOrangTua = '6285712911758';  // Nomor WhatsApp orang tua
                    // $pesan = "Anak Anda telah melakukan presensi pulang pada pukul " . date('H:i') . ". Terima kasih.";
                    // $this->kirimPesanWhatsAppFonnte($nomorOrangTua, $pesan);
                } else {
                    echo "error|Maaf Gagal absen, Hubungi Tim IT|out";
                }
            } else {
                // Presensi masuk
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success|Terimakasih, Selamat Belajar|in";
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://localhost:8000/wagateway.pedasalamai.com/send-massage',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('message' => 'Terimakasih anda sudah presensi masuk, Anak anda melakukan presensi masuk di jam ' . $jam ,'number' => '085712911758','file_dikirim'=> ''),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    echo $response;
                    Storage::put($file, $image_base64);

                    // // Kirim notifikasi ke orang tua saat presensi masuk
                    // $nomorOrangTua = '6285526366762';  // Nomor WhatsApp orang tua
                    // $pesan = "Anak Anda telah melakukan presensi masuk pada pukul " . date('H:i') . ". Terima kasih.";
                    // $this->kirimPesanWhatsAppFonnte($nomorOrangTua, $pesan);
                } else {
                    echo "error|Maaf Gagal absen, Hubungi Tim IT|out";
                }
            }
        }
    }

    // Fungsi untuk menghitung jarak (misalkan fungsi ini sudah ada)
    // private function distance($lat1, $lon1, $lat2, $lon2)
    // {
    //     // Kode untuk menghitung jarak antara dua titik koordinat
    //     // ...
    // }


    public function create()
    {
        $hariini = date("Y-m-d");
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->count();
        $lok_sekolah = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        return view('presensi.create', compact('cek', 'lok_sekolah'));
    }

    // public function kirimPesanWhatsAppFonnte($to, $message)
    // {
    //     $apiKey = 'YOUR_FONNTE_API_KEY';  // Ganti dengan API Key Fonnte Anda
        
    //     // Kirim request ke API Fonnte
    //     $response = Http::withHeaders([
    //         'Authorization' => $apiKey
    //     ])->post('https://api.fonnte.com/send', [
    //         'target' => $to,
    //         'message' => $message,
    //         'delay' => 2, // delay dalam detik
    //         'countryCode' => '62' // kode negara, 62 untuk Indonesia
    //     ]);

    //     return $response->json();
    // }
    // public function store(Request $request)
    // {
    //     $nik = Auth::guard('karyawan')->user()->nik;
    //     $tgl_presensi = date("Y-m-d");
    //     $jam = date("H:i:s");
    //     $lok_sekolah = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
    //     $lok = explode(",", $lok_sekolah->lokasi_sekolah);
    //     $latitudekantor = $lok[0]; 
    //     $longitudekantor = $lok[1] ;
    //     $lokasi = $request->lokasi;
    //     $lokasiuser = explode(",", $lokasi);
    //     $latitudeuser = $lokasiuser[0];
    //     $longitudeuser = $lokasiuser[1];

    //     $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
    //     $radius = round($jarak["meters"]);

    //     $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();

    //     if ($cek > 0) {
    //         $ket = "out";
    //     }else {
    //         $ket = "in";
    //     }

    //     $image = $request->image;
    //     $folderPath = "public/uploads/absensi/";
    //     $formatName = $nik . "-" . $tgl_presensi . "-" . $ket; 
    //     $image_parts = explode(";base64", $image);
    //     $image_base64 = base64_decode($image_parts[1]);
    //     $fileName = $formatName . ".png";
    //     $file = $folderPath . $fileName;
        
    //     if($radius > $lok_sekolah->radius){
    //         echo "error|Maaf Anda Berada diluar Radius, Jarak Anda " . $radius . " meter dari Sekolah|";
    //     }else{
    //         if ($cek > 0) {
    //             $data_pulang = [
    //                 'jam_out' => $jam,
    //                 'foto_out' => $fileName,
    //                 'lokasi_out' => $lokasi
    //             ];
    //             $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
    //             if ($update) {
    //                 echo "success|Terimakasih, Hati-hati di jalan|out";
    //                 Storage::put($file, $image_base64);
    //             } else {
    //                 echo "error|Maaf Gagal absen, Hubungi Tim IT|out";
    //             }
    //         } else {
    //             $data = [
    //                 'nik' => $nik,
    //                 'tgl_presensi' => $tgl_presensi,
    //                 'jam_in' => $jam,
    //                 'foto_in' => $fileName,
    //                 'lokasi_in' => $lokasi
    //             ];
    //             $simpan = DB::table('presensi')->insert($data);
    //             if ($simpan) {
    //                 $nomorOrangTua = '6285526366762';  // Pastikan format nomor diawali '62' tanpa tanda '+'
    //                 $pesan = "Anak Anda telah melakukan presensi masuk pada pukul " . date('H:i') . ". Terima kasih.";

    //                 // Kirim notifikasi ke orang tua
    //                 $this->kirimPesanWhatsAppFonnte($nomorOrangTua, $pesan);

    //                 // Respon atau redirect setelah berhasil menyimpan presensi
    //                 // return redirect()->back()->with('success', 'Presensi berhasil dan notifikasi dikirim ke orang tua.');
                
    //                 echo ("success|Terimakasih, Selamat Belajar|in");
    //                 Storage::put($file, $image_base64);
    //                 // $simpan = DB::table('presensi')->insert($data);
    //                 // if ($simpan) {
    //                 // Kirim notifikasi ke WhatsApp
    //                 // $nomorOrangTua = '6285526366762'; // Ganti dengan nomor WhatsApp orang tua
    //                 // $namaSiswa = 'Firma'; // Ganti dengan nama siswa sesuai data
                    
    //                 // $this->kirimNotifikasiWhatsApp($nomorOrangTua, $namaSiswa);

    //                 // echo ("success|Terimakasih, Selamat Belajar|in");
    //                 // Storage::put($file, $image_base64);
    //             } else {
    //                 echo "error|Maaf Gagal absen, Hubungi Tim IT|out";
    //             }
    //         }
    //     }
        
    // }
    // Menghitung jarak 
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile()
    {

        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        // dd($karyawan);
        return view('presensi.editprofile', compact('karyawan'));
    }

    public function updateprofile(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }
        
        if (empty($request->password)) {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto

            ];
        }

        $update = DB::table('karyawan')->where('nik', $nik)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/karyawan/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update']);
        }
        
    }

    public function histori()
    {
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return view('presensi.histori', compact('namabulan'));
    }

    public function gethistori(Request $request) 
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;

        $histori = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->where('nik', $nik)
            ->orderBy('tgl_presensi')
            ->get();

            // dd($histori);
        return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik', $nik)->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function buatizin()
    {
        
        return view('presensi.buatizin');
    }

    public function storeizin(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;
        
        $data = [
            'nik' => $nik,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if ($simpan){
            return redirect('/presensi/izin')->with(['success'=>'Data Berhasil Disismpan']);
        }else{
            return redirect('/presensi/izin')->with(['error'=>'Data Gagal Disismpan']);
        }
    }

    public function monitoring()
    {

        $kelas = Kelas::all(); // Mengambil data kelas dari model
        
        return view('presensi.monitoring',compact('kelas'));
    }

    // public function monitoring(Request $request) {
    //     $tanggal = $request->input('tanggal');
    //     $kelas = $request->input('kelas');
    
    //     // Lakukan query berdasarkan kelas dan tanggal
    //     $presensi = DB::table('presensi')
    //               ->where('tgl_presensi', $tanggal)
    //               ->where('kelas.kode_kelas', $kelas) // Filter berdasarkan kelas yang dipilih
    //               ->join('kelas', 'presensi.kode_kelas', '=', 'kelas.kode_kelas') // Join ke tabel kelas
    //               ->select('presensi.*', 'kelas.nama_kelas') // Pilih kolom yang diinginkan dari kedua tabel
    //               ->get();
    
    //     return view('presensi.monitoring', compact('presensi'));
    // }

//     public function monitoring(Request $request)
// {
//     // Ambil input tanggal dan kelas
//     $tanggal = $request->input('tanggal');
//     $kelasInput = $request->input('kelas'); // Ubah nama variabel untuk input kelas

//     // Query data presensi dengan filter
//     $query = DB::table('presensi')
//         ->join('kelas', 'presensi.nik', '=', 'kelas.kode_kelas')  // Join berdasarkan kode_kelas
//         ->select('presensi.*', 'kelas.nama_kelas');

//     // Terapkan filter jika ada
//     if ($tanggal) {
//         $query->whereDate('tgl_presensi', '=', $tanggal);
//     }
//     if ($kelasInput) {
//         $query->where('presensi.kode_kelas', '=', $kelasInput); // Filter berdasarkan kelas
//     }

//     // Ambil data presensi setelah query diterapkan
//     $presensi = $query->get();

//     // Ambil data kelas untuk dropdown
//     $kelasList = DB::table('kelas')->get();

//     // Kirim data ke view
//     return view('presensi.monitoring', compact('presensi', 'kelasList'));
// }

    

    


    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
            ->select('presensi.*', 'nama_lengkap', 'nama_kelas')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->join('kelas', 'karyawan.kode_kelas', '=', 'kelas.kode_kelas')
            ->where('tgl_presensi', $tanggal)
            ->get();

            if ($presensi->isEmpty()) {
                return response()->json(['error' => 'Data presensi tidak ditemukan'], 404);
            }

            return view('presensi.getpresensi', compact('presensi'));
    }


    public function tampilkanpeta(Request $request) 
    {
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id', $id)
        ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
        ->first();
        return view('presensi.showmap', compact('presensi'));
    }

    public function laporan()
    {
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        $kelas = DB::table('kelas')->get();
        return view('presensi.laporan',compact('namabulan','karyawan','kelas'));
    }

    public function cetaklaporan( Request $request)
    {
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $karyawan = DB::table('karyawan')->where('nik', $nik)
        ->join('kelas', 'karyawan.kode_kelas', '=', 'kelas.kode_kelas')
        ->first();
        $presensi = DB::table('presensi')
        ->where('nik',$nik)
        ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
        ->orderBy('tgl_presensi')
        ->get();

        // Tambahkan kolom 'keterangan' secara dinamis
        $presensi = $presensi->map(function ($item) {
            // Pastikan properti 'keterangan' didefinisikan terlebih dahulu
            $item->keterangan = null;

            // Logika menentukan keterangan
            if (is_null($item->jam_in) && is_null($item->jam_out)) {
                $item->keterangan = 'Alpha'; // Tidak ada presensi
            } elseif ($item->keterangan === 'S') {
                $item->keterangan = 'Sakit'; // Sesuaikan kode
            } elseif ($item->keterangan === 'I') {
                $item->keterangan = 'Izin'; // Sesuaikan kode
            } else {
                $item->keterangan = 'Hadir'; // Default: Hadir
            }

            return $item; // Kembalikan data dengan keterangan
        });

        if (isset($_POST['exportexcel'])) {
            $time = date("d-M-Y H:i:s");
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Presensi Siswa $time.xls");
            return view('presensi.cetaklaporanexcel', compact('bulan','tahun','namabulan','karyawan','presensi'));

        }
        return view('presensi.cetaklaporan', compact('bulan','tahun','namabulan','karyawan','presensi'));
    }

    public function rekap()
    {
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $kelas = DB::table('kelas')->get();
        return view('presensi.rekap',compact('namabulan','kelas'));
    }

    public function cetakrekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $kode_kelas = $request->kode_kelas;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $rekap = DB::table('presensi')
        ->selectRaw('presensi.nik, nama_lengkap,
            MAX(IF(DAY(tgl_presensi) = 1, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_1,
            MAX(IF(DAY(tgl_presensi) = 2, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_2,
            MAX(IF(DAY(tgl_presensi) = 3, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_3,
            MAX(IF(DAY(tgl_presensi) = 4, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_4,
            MAX(IF(DAY(tgl_presensi) = 5, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_5,
            MAX(IF(DAY(tgl_presensi) = 6, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_6,
            MAX(IF(DAY(tgl_presensi) = 7, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_7,
            MAX(IF(DAY(tgl_presensi) = 8, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_8,
            MAX(IF(DAY(tgl_presensi) = 9, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_9,
            MAX(IF(DAY(tgl_presensi) = 10, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_10,
            MAX(IF(DAY(tgl_presensi) = 11, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_11,
            MAX(IF(DAY(tgl_presensi) = 12, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_12,
            MAX(IF(DAY(tgl_presensi) = 13, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_13,
            MAX(IF(DAY(tgl_presensi) = 14, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_14,
            MAX(IF(DAY(tgl_presensi) = 15, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_15,
            MAX(IF(DAY(tgl_presensi) = 16, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_16,
            MAX(IF(DAY(tgl_presensi) = 17, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_17,
            MAX(IF(DAY(tgl_presensi) = 18, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_18,
            MAX(IF(DAY(tgl_presensi) = 19, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_19,
            MAX(IF(DAY(tgl_presensi) = 20, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_20,
            MAX(IF(DAY(tgl_presensi) = 21, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_21,
            MAX(IF(DAY(tgl_presensi) = 22, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_22,
            MAX(IF(DAY(tgl_presensi) = 23, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_23,
            MAX(IF(DAY(tgl_presensi) = 24, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_24,
            MAX(IF(DAY(tgl_presensi) = 25, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_25,
            MAX(IF(DAY(tgl_presensi) = 26, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_26,
            MAX(IF(DAY(tgl_presensi) = 27, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_27,
            MAX(IF(DAY(tgl_presensi) = 28, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_28,
            MAX(IF(DAY(tgl_presensi) = 29, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_29,
            MAX(IF(DAY(tgl_presensi) = 30, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_30,
            MAX(IF(DAY(tgl_presensi) = 31, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_31')
            // ->join('karyawan','presensi.nik', '=', 'karyawan.nik')
            // ->whereRaw('MONTH(tgl_presensi)="' .$bulan . '"')
            // ->whereRaw('YEAR(tgl_presensi)="' .$tahun . '"')
            // ->groupByRaw('presensi.nik,nama_lengkap')
            // ->get();

            // $query = Kelas::query();

            // if (!empty($kode_kelas)) {
            //     $query->where('kode_kelas',$kode_kelas);
            // }

                ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik') // Hubungkan presensi dengan karyawan
                ->join('kelas', 'karyawan.kode_kelas', '=', 'kelas.kode_kelas') // Hubungkan dengan kelas
                ->whereRaw('MONTH(tgl_presensi) = ?', [$bulan])
                ->whereRaw('YEAR(tgl_presensi) = ?', [$tahun]);

            // Tambahkan filter untuk kode_kelas jika diberikan
            if (!empty($kode_kelas)) {
                $rekap->where('kelas.kode_kelas', $kode_kelas);
            }

            $rekap = $rekap->groupByRaw('presensi.nik, nama_lengkap')
                ->get();

            // dd($rekap);

            if (isset($_POST['exportexcel'])) {
                $time = date("d-M-Y H:i:s");
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Rekap Presensi Siswa $time.xls");
            }
            

        return view('presensi.cetakrekap',compact('bulan','tahun','namabulan','rekap'));
    }

    public function izinsakit(Request $request)
    {
        $query = Pengajuanizin::query();
        $query->select('id','tgl_izin','pengajuan_izin.nik','nama_lengkap','kode_kelas','status','status_approved','keterangan');
        $query->join('karyawan','pengajuan_izin.nik','=','karyawan.nik');
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('tgl_izin',[$request->dari, $request->sampai]);
        }

        if (!empty($request->nik)) {
            $query->where('pengajuan_izin.nik', $request->nik);
        }
        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'like','%' . $request->nama_lengkap . '%');
        }
        if ($request->status_approved == '0' || $request->status_approved == '1' || $request->status_approved == '2') {
            $query->where('status_approved', $request->status_approved);
        }
        $query->orderBy('tgl_izin','desc');
        $izinsakit = $query->paginate(5);
        $izinsakit->appends($request->all());
        return view('presensi.izinsakit', compact('izinsakit'));
    }

    public function approveizinsakit(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('pengajuan_izin')->where('id', $id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
    }

    public function batalkanizinsakit($id)
    {
        $update = DB::table('pengajuan_izin')->where('id', $id)->update([
            'status_approved' => 0
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
        
    }

    public function cekpengajuanizin(Request $request)
    {
        $tgl_izin = $request->tgl_izin;
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('pengajuan_izin')->where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();
        return $cek;
    }

    // private function kirimNotifikasiWhatsApp($nomorOrangTua, $namaSiswa) {
    //     $pesan = "Halo, ini notifikasi bahwa $namaSiswa telah melakukan presensi masuk ke sekolah.";
    
    //     // Contoh menggunakan Twilio, ganti dengan API yang Anda gunakan
    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer YOUR_API_KEY' // Ganti dengan API Key dari penyedia API
    //     ])->post('https://api.whatsapp.com/send', [
    //         'to' => $nomorOrangTua,
    //         'body' => $pesan,
    //         'from' => 'YOUR_WHATSAPP_NUMBER' // Nomor WhatsApp yang terdaftar di API
    //     ]);
    
    //     return $response->successful();
    // }


    
}

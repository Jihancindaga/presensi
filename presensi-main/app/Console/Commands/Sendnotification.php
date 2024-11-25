<?php

namespace App\Console\Commands;

use App\Models\Karyawan;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendReminderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim notifikasi Whatsapp Pajak dan Kenaikan Gaji/Pangkat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $kendaraansPlatUpdate = Vehicle::whereDate('ganti_plat', Carbon::now()->addMonth())->get();
        $kendaraans = Vehicle::whereDate('waktu_pajak', Carbon::now()->addMonth())->get();
        $kenaikanGaji = Karyawan::whereDate('tanggal_kenaikan_gaji', Carbon::now()->addMonths(2))->get();
        $kenaikanPangkat = Karyawan::whereDate('tanggal_kenaikan_pangkat', Carbon::now()->addMonths(2))->get();

        foreach ($kendaraansPlatUpdate as $kendaraanPlat) {
            $nowa = $kendaraanPlat->nomor_telepon;
            Carbon::setLocale('id');
            $pesan = 'Reminder: Pajak Plat kendaraan Anda akan jatuh tempo pada ' . Carbon::parse($kendaraanPlat->waktu_pajak)->translatedFormat('d F Y') . ".\n" . 'Dengan detail Kendaraan: ' . "\n" . 'Plat: ' . $kendaraanPlat->plat . "\n" . 'Jenis: ' . $kendaraanPlat->jenis_kendaraan . "\n" . 'Merk: ' . $kendaraanPlat->merk_kendaraan . "\n" . 'Pengguna: ' . $kendaraanPlat->pengguna . "\n\n" . 'Mohon segera melakukan pembayaran pajak sebelum tanggal jatuh tempo. Terima kasih😊😊.';

            $this->sendNotification($nowa, $pesan);
        }

        foreach ($kendaraans as $kendaraan) {
            $nowa = $kendaraan->nomor_telepon;
            Carbon::setLocale('id');
            $pesan = 'Reminder: Pajak kendaraan Anda akan jatuh tempo pada ' . Carbon::parse($kendaraan->waktu_pajak)->translatedFormat('d F Y') . ".\n" . 'Dengan detail Kendaraan: ' . "\n" . 'Plat: ' . $kendaraan->plat . "\n" . 'Jenis: ' . $kendaraan->jenis_kendaraan . "\n" . 'Merk: ' . $kendaraan->merk_kendaraan . "\n" . 'Pengguna: ' . $kendaraan->pengguna . "\n\n" . 'Mohon segera melakukan pembayaran pajak sebelum tanggal jatuh tempo. Terima kasih😊😊.';

            $this->sendNotification($nowa, $pesan);
        }

        foreach ($kenaikanGaji as $gaji) {
            $nowa = $gaji->no_telp;
            Carbon::setLocale('id');
            $pesan = 'Reminder: Kenaikan Gaji Anda pada ' . Carbon::parse($gaji->tanggal_kenaikan_gaji)->translatedFormat('d F Y') . ".\n" . 'Dengan detail Karyawan: ' . "\n" . 'NIP: ' . $gaji->nip . "\n" . 'Nama: ' . $gaji->nama . "\n" . 'Tanggal Kenaikan: ' . $gaji->tanggal_kenaikan_gaji . "\n" . 'Golongan: ' . $gaji->golongan . "\n" . 'Pangkat: ' . $gaji->pangkat . "\n" . 'Jabatan: ' . $gaji->jabatan . "\n\n" . 'Mohon segera melengkapi berkas yang diperlukan untuk kenaikan gaji. Terima kasih😊😊.';

            $this->sendNotification($nowa, $pesan);
        }

        foreach ($kenaikanPangkat as $pangkat) {
            $nowa = $pangkat->no_telp;
            Carbon::setLocale('id');
            $pesan = 'Reminder: Kenaikan Pangkat Anda pada ' . Carbon::parse($pangkat->tanggal_kenaikan_pangkat)->translatedFormat('d F Y') . ".\n" . 'Dengan detail Karyawan: ' . "\n" . 'NIP: ' . $pangkat->nip . "\n" . 'Nama: ' . $pangkat->nama . "\n" . 'Tanggal Kenaikan: ' . $pangkat->tanggal_kenaikan_pangkat . "\n" . 'Golongan: ' . $pangkat->golongan . "\n" . 'Pangkat: ' . $pangkat->pangkat . "\n" . 'Jabatan: ' . $pangkat->jabatan . "\n\n" . 'Mohon segera melengkapi berkas yang diperlukan untuk kenaikan pangkat. Terima kasih😊😊.';

            $this->sendNotification($nowa, $pesan);
        }

        $kendaraansPlatUpdate = Vehicle::whereDate('ganti_plat', Carbon::now())->get();
        $kendaraansUpdate = Vehicle::whereDate('waktu_pajak', Carbon::now())->get();
        $gajiUpdate = Karyawan::whereDate('tanggal_kenaikan_gaji', Carbon::now())->get();
        $pangkatUpdate = Karyawan::whereDate('tanggal_kenaikan_pangkat', Carbon::now())->get();

        foreach ($kendaraansPlatUpdate as $kendaraan) {
            $kendaraan->update([
                'ganti_plat' => Carbon::now()->addYears(5)->format('Y-m-d'),
            ]);
        }

        foreach ($kendaraansUpdate as $kendaraan) {
            $kendaraan->update([
                'waktu_pajak' => Carbon::now()->addYear()->format('Y-m-d'),
            ]);
        }

        foreach ($gajiUpdate as $gaji) {
            $gaji->update([
                'tanggal_kenaikan_gaji' => Carbon::now()->addYears(2)->format('Y-m-d'),
            ]);
        }

        foreach ($pangkatUpdate as $pangkat) {
            $pangkat->update([
                'tanggal_kenaikan_pangkat' => Carbon::now()->addYears(4)->format('Y-m-d'),
            ]);
        }
    }

    public function sendNotification($nowa, $pesan)
    {
        $token = '##tZKBP_Dp_gHypkBQVJ';

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $nowa,
            'message' => $pesan,
        ]);

        if ($response->successful()) {
            $this->info('Notifikasi terkirim ke ' . $nowa);
        } else {
            $this->error('Gagal mengirim notifikasi ke ' . $nowa);
        }
    }
}
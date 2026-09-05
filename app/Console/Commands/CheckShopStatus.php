<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckShopStatus extends Command
{
    /**
     * Signature/nama command dan argumen opsional jam.
     */
    protected $signature = 'pos:status {jam?}';

    /**
     * Deskripsi perintah saat dilihat melalui 'php artisan list'.
     */
    protected $description = 'Mengecek status operasional Toko Kelontong POS';

    /**
     * Logika utama perintah.
     */
    public function handle()
    {
        // 1. Modifikasi Tugas Mandiri: Menanyakan nama kasir yang bertugas
        $namaKasir = $this->ask('Masukkan nama Anda');

        // 2. Tahap 1: Mengambil argumen jam, jika kosong default ke jam 10
        $jam = $this->argument('jam') ?? 10;

        $this->info("=== SISTEM MONITORING TOKO KELONTONG ===");

        // 3. Pengecekan kondisi jam operasional (Buka: 08:00 - 21:00 WIB)
        if ($jam >= 8 && $jam <= 21) {
            // Output status BUKA (teks hijau)
            $this->info("Halo {$namaKasir}, Status Toko pada jam {$jam}:00 WIB adalah: BUKA");
            $this->comment("Silakan kasir bersiap di meja transaksi.");
        } else {
            // Output status TUTUP (teks/background merah)
            $this->error("Halo {$namaKasir}, Status Toko pada jam {$jam}:00 WIB adalah: TUTUP");
            $this->warn("Akses transaksi kasir dinonaktifkan sementara.");
        }
    }
}
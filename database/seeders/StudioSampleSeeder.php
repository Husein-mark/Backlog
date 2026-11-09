<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;

class StudioSampleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tambah Contoh Alat Studio
        $kamera = Barang::create([
            'nama_barang' => 'Kamera Sony A6400',
            'kode_barang' => 'CAM-001',
            'kategori'    => 'Kamera',
            'status'      => 'dipinjam',
        ]);

        Barang::create([
            'nama_barang' => 'Tripod Takara ECO-193A',
            'kode_barang' => 'TRP-001',
            'kategori'    => 'Aksesoris',
            'status'      => 'tersedia',
        ]);

        Barang::create([
            'nama_barang' => 'Wireless Mic Boya WM4',
            'kode_barang' => 'MIC-001',
            'kategori'    => 'Audio',
            'status'      => 'tersedia',
        ]);

        // 2. Ambil user siswa (Alwi Husein)
        $siswa = User::where('role', 'siswa')->first();

        // 3. Tambah Contoh 1 Peminjaman yang sedang berjalan
        if ($siswa && $kamera) {
            Peminjaman::create([
                'user_id'                 => $siswa->id,
                'barang_id'               => $kamera->id,
                'tanggal_pinjam'          => now()->subDays(2),
                'tanggal_kembali_rencana' => now()->addDays(2),
                'status'                  => 'dipinjam',
                'kondisi_awal'            => 'Baik, lensa bersih, baterai 100%',
                'kondisi_akhir'           => null,
                'catatan_kondisi'         => null,
            ]);
        }
    }
}
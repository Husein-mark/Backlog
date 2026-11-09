<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    // Supaya Laravel membaca tabel 'peminjamans' dengan tepat
    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'barang_id',
        'tanggal_pinjam',
        'tanggal_kembali_rencana',
        'tanggal_kembali_aktual',
        'status',
        'kondisi_awal',
        'kondisi_akhir',
        'catatan_kondisi',
    ];

    // Relasi ke Siswa peminjam
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Barang yang dipinjam
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
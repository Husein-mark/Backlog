<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class KondisiBarangController extends Controller
{
    // Menampilkan daftar peminjaman yang perlu dicek kondisinya
    public function index()
    {
        // Pastikan hanya guru yang bisa membuka halaman ini
        if (Auth::user()->role !== 'guru') {
            abort(403, 'Akses khusus Guru/Pengelola Studio');
        }

        // Ambil data peminjaman beserta info siswa dan barangnya
        $peminjamans = Peminjaman::with(['user', 'barang'])
            ->latest()
            ->get();

        return view('kondisi.index', compact('peminjamans'));
    }

    // Menyimpan catatan kondisi saat barang dikembalikan oleh siswa
    public function update(Request $request, $id)
    {
        $request->validate([
            'kondisi_akhir'   => 'required|string',
            'catatan_kondisi' => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        // Update data pengembalian & kondisi barang
        $peminjaman->update([
            'kondisi_akhir'          => $request->kondisi_akhir,
            'catatan_kondisi'        => $request->catatan_kondisi,
            'tanggal_kembali_aktual' => now(),
            'status'                 => 'dikembalikan',
        ]);

        // Jika kondisi akhir ternyata Rusak, ubah status barang di studio jadi 'rusak'
        $barang = $peminjaman->barang;
        if (in_array($request->kondisi_akhir, ['Rusak Ringan', 'Rusak Berat', 'Hilang'])) {
            $barang->update(['status' => 'rusak']);
        } else {
            $barang->update(['status' => 'tersedia']);
        }

        return redirect()->back()->with('success', 'Pencatatan kondisi pengembalian barang berhasil disimpan!');
    }
}
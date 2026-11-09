<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
        $table->id();
        // Terhubung ke peminjam (siswa) dan barang studio
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
        
        // Tanggal peminjaman & tenggat waktu
        $table->date('tanggal_pinjam');
        $table->date('tanggal_kembali_rencana');
        $table->date('tanggal_kembali_aktual')->nullable();
        $table->enum('status', ['pending', 'disetujui', 'ditolak', 'dipinjam', 'dikembalikan', 'terlambat'])->default('dipinjam');

        // === TUGAS ALWI: Pencatatan Kondisi Barang ===
        $table->string('kondisi_awal')->default('Baik'); // Kondisi saat diserahkan
        $table->string('kondisi_akhir')->nullable();     // Kondisi saat dikembalikan
        $table->text('catatan_kondisi')->nullable();     // Catatan jika ada goresan/rusak

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};

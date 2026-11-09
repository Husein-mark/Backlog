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
        Schema::create('barangs', function (Blueprint $table) {
        $table->id();
        $table->string('nama_barang'); // Contoh: Kamera Sony A6400, Tripod Takara
        $table->string('kode_barang')->unique(); // Contoh: CAM-001, MIC-002
        $table->string('kategori')->default('Studio'); // Kamera, Audio, Lighting
        $table->enum('status', ['tersedia', 'dipinjam', 'rusak'])->default('tersedia');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};

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
        Schema::create('riwayat_cadangans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            // tanggal dipinjam
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('kendaraan_spesifikasi_id')->constrained('kendaraan_spesifikasis')->cascadeOnUpdate()->cascadeOnDelete();
            // kendaraan & driver asal
            $table->string('nopol');
            // plat nomor kendaraan yang dipinjam
            $table->string('driver');
            // pengguna kendaraan yang dipinjam
            $table->string('alasan');
            // alasan pindah kendaraan
            $table->string('keterangan');
            // tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_cadangans');
    }
};

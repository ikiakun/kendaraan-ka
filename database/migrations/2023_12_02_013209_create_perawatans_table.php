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
        Schema::create('perawatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('kendaraan_spesifikasi_id')->constrained('kendaraan_spesifikasis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('perawatan_jenis_id')->constrained('perawatan_jenis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('perawatan_status_id')->constrained('perawatan_statuses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('penanganan');
            $table->date('tgl');
            $table->date('tgl_cek_ulang')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('kilometer')->nullable();
            $table->string('kilometer_cek_ulang')->nullable();
            $table->string('foto_nota')->nullable();
            $table->string('foto_sparepart')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perawatans');
    }
};

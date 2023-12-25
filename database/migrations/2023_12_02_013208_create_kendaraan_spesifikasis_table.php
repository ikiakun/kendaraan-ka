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
        Schema::create('kendaraan_spesifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('kendaraan_jenis_id')->constrained('kendaraan_jenis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('plat_nomor');
            $table->string('driver');
            $table->string('nomor_rangka');
            $table->integer('tahun')->nullable();
            // tahun pembuatan
            $table->string('atas_nama')->nullable();
            // pemilik kendaraan
            $table->date('berlaku_stnk');
            $table->date('berlaku_kir');
            $table->date('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan_spesifikasis');
    }
};

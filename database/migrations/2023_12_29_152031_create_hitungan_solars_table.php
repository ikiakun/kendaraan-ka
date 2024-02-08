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
        Schema::create('hitungan_solars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_spesifikasi_id')->constrained('kendaraan_spesifikasis');
            $table->string('driver');
            // $table->string('nopol');
            $table->foreignId('user_id')->constrained('users');
            $table->date('tgl_awal');
            $table->date('tgl_akhir')->nullable();
            $table->integer('kilometer_awal');
            $table->integer('kilometer_akhir')->nullable();
            $table->integer('jarak')->nullable();
            $table->integer('solar_awal');
            $table->integer('solar_akhir')->nullable();
            $table->integer('perliter')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitungan_solars');
    }
};

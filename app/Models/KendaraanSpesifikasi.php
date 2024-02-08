<?php

namespace App\Models;

use App\Models\User;
use App\Models\KendaraanJenis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KendaraanSpesifikasi extends Model
{
    use HasFactory;

    // protected $table = "kendaraan_spesifikasis";
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kendaraan_jenis() {
        return $this->belongsTo(KendaraanJenis::class);
    }

    public function riwayat_cadangan() {
        return $this->hasMany(RiwayatCadangan::class);
    }

    public function hitungan_solar() {
        return $this->hasMany(HitunganSolar::class);
    }
}

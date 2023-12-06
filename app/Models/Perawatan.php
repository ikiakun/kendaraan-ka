<?php

namespace App\Models;

use App\Models\User;
use App\Models\PerawatanJenis;
use App\Models\PerawatanStatus;
use App\Models\KendaraanSpesifikasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perawatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kendaraan_spesifikasi() {
        return $this->belongsTo(KendaraanSpesifikasi::class);
    }

    public function perawatan_status() {
        return $this->belongsTo(PerawatanStatus::class);
    }

    public function perawatan_jenis() {
        return $this->belongsTo(PerawatanJenis::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}

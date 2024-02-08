<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HitunganSolar extends Model
{
    use HasFactory;

    protected $guarded = [];

    function kendaraan_spesifikasi() {
        return $this->belongsTo(KendaraanSpesifikasi::class);
    }
}

<?php

namespace App\Models;

use App\Models\Perawatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerawatanStatus extends Model
{
    use HasFactory;

    protected $table = "perawatan_statuses";
    protected $guarded = [];

    public function perawatan() {
        return $this->belongsTo(Perawatan::class);
    }
}

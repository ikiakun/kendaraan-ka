<?php

namespace App\Models;

use App\Models\User;
use App\Models\Perawatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerawatanJenis extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function perawatan() {
        return $this->hasMany(Perawatan::class);
    }
}

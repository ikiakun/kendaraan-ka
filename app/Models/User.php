<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Perawatan;
use App\Models\KendaraanJenis;
use App\Models\PerawatanJenis;
use Laravel\Sanctum\HasApiTokens;
use App\Models\KendaraanSpesifikasi;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'jabatan',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function kendaraan_jenis() {
        return $this->hasMany(KendaraanJenis::class);
    }

    public function perawatan_jenis() {
        return $this->hasMany(PerawatanJenis::class);
    }

    public function perawatans() {
        return $this->hasMany(Perawatan::class);
    }

    public function kendaraan_spesifikasi() {
        return $this->hasMany(KendaraanSpesifikasi::class);
    }

    public function riwayat_cadangan() {
        return $this->hasMany(RiwayatCadangan::class);
    }
}

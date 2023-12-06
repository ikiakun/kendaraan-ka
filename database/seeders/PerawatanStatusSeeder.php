<?php

namespace Database\Seeders;

use App\Models\PerawatanStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerawatanStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = PerawatanStatus::create([
            'nama' => 'Belum diperiksa',
            'nama' => 'Belum diajukan',
            'nama' => 'Sedang Ditangani',
            'nama' => 'Selesai',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\PerawatanJenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerawatanJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['jenis' => 'STNK'],
            ['jenis' => 'KIR'],
            ['jenis' => 'Ganti Oli Mesin'],
            ['jenis' => 'Ganti Oli Gardan'],
            ['jenis' => 'Ganti Coolant'],
            ['jenis' => 'Bersihkan/ganti Filter Udara'],
            ['jenis' => 'Ganti Filter Solar'],
            ['jenis' => 'Ganti Ban'],
            ['jenis' => 'Ganti Timing Belt'],
            ['jenis' => 'Lainnya']
        ];

        foreach ($data as $item){
            PerawatanJenis::insert([
                'jenis' =>$item['jenis'],
                'user_id' => 1,
            ]);
        }
    }
}

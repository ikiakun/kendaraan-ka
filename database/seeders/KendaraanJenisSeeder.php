<?php

namespace Database\Seeders;

use App\Models\KendaraanJenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KendaraanJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['jenis' => 'Elf'],
            ['jenis' => 'Traga'],
        ];

        foreach ($data as $item){
            KendaraanJenis::insert([
                'jenis' =>$item['jenis'],
                'user_id' => 1,
            ]);
        }
    }
}

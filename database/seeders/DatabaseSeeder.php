<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\KendaraanJenis;
use App\Models\PerawatanJenis;
use App\Models\PerawatanStatus;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(UserSeeder::class);
        $this->call(PerawatanStatusSeeder::class);
        $this->call(PerawatanJenisSeeder::class);
        $this->call(KendaraanJenisSeeder::class);
    }

}

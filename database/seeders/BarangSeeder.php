<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;



class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('ALTER TABLE barang AUTO_INCREMENT = 2');
        // mulai dari ID 2
        Barang::factory()
            ->count(100)
            ->create();
    }
}
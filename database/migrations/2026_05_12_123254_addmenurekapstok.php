<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;



return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('menu')->insert([
            [
                'nama_menu' => 'Rekap Stok Barang',
                'nama_menu_opsional' => 'rekapStokBarang',
                'url' => '/rekapStokBarang',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => 'history',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('menu')->where('nama_menu_opsional', 'rekapStokBarang')->delete();
    }
};

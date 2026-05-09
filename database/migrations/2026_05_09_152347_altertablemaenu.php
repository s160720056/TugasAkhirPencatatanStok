<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('menu')
            ->where('id_menu', 6)
            ->update([
                'nama_menu' => 'Transaksi/Barang Keluar'
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('menu')
            ->where('id_menu', 6)
            ->update([
                'nama_menu' => 'Nama Sebelumnya'
            ]);
    }
};
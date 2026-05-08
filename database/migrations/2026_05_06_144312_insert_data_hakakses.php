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
        DB::table('hak_akses')->insert([
            'id_hak_akses' => '1',
            'id_toko' => '1',
            'nama_hak_akses' => 'MANAGER'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('hak_akses')
            ->where('id_hak_akses', '1')
            ->where('id_toko', '1')
            ->where('nama_hak_akses', 'MANAGER')
            ->delete();
    }
};

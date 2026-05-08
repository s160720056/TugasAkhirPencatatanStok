<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up(): void
    {
        DB::table('menu')->insert([
            [
                'nama_menu' => 'Home',
                'nama_menu_opsional' => 'home',
                'url' => '/home',
                'icon' => 'home',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'User',
                'nama_menu_opsional' => 'user',
                'url' => '/user',
                'icon' => 'group',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Hak Akses',
                'nama_menu_opsional' => 'hakAkses',
                'url' => '/hakAkses',
                'icon' => 'key',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Pengaturan',
                'nama_menu_opsional' => 'pengaturan',
                'url' => '/pengaturan',
                'icon' => 'settings',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Barang',
                'nama_menu_opsional' => 'barang',
                'url' => '/barang',
                'icon' => 'inventory_2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('menu')->truncate(); // hapus semua data
    }
};

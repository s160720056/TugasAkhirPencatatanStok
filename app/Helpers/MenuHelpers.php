<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class MenuHelper
{
    public static function safeDeleteByName(string $namaMenu): void
    {
        DB::transaction(function () use ($namaMenu) {

            // Aktifkan bypass trigger
            DB::statement('SET @ALLOW_MENU_DELETE = 1');

            // Hapus hak akses dulu (child table)
            DB::table('hak_akses_menu')
                ->join('menu', 'hak_akses_menu.id_menu', '=', 'menu.id_menu')
                ->where('menu.nama_menu', $namaMenu)
                ->delete();

            // Hapus menu
            DB::table('menu')
                ->where('nama_menu', $namaMenu)
                ->delete();

            // Matikan bypass trigger
            DB::statement('SET @ALLOW_MENU_DELETE = 0');
        });
    }
}

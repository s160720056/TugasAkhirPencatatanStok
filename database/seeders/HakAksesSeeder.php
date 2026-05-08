<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      //superadmin,kasir,admin
        $hakAkses = [
            ['id_hak_akses'=>4,'nama_hak_akses' => 'tidak ada'],
            ['id_hak_akses'=>1,'nama_hak_akses' => 'superadmin'],
            ['id_hak_akses'=>2,'nama_hak_akses' => 'admin'],
            ['id_hak_akses'=>3,'nama_hak_akses' => 'kasir'],

        ];

        foreach ($hakAkses as $hakAkses) {
            \App\Models\HakAkses::create($hakAkses);
        }

        //run cli
        //php artisan db:seed --class=HakAksesSeeder

    }
}

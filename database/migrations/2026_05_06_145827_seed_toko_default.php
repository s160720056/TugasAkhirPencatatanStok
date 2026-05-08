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
         DB::table('toko')->insert([
            [
                'id_toko' => 1,
                'nama_toko' => 'Toko Maju Jaya',
                'alamat_toko' => 'Jl. Sudirman No. 123',
                'email_toko' => 'tokomaju@gmail.com',
                'tlp' => '081234567890',
                'nama_pemilik' => 'Budi Santoso',

                'ppn' => '11%',

                'jam_buka' => '08:00:00',
                'jam_tutup' => '21:00:00',

                'toleransi_terlambat' => 10,
                'denda_keterlambatan' => 5000,

                'lebar_kertas_struk' => '58mm',

                'format_struk' => '1',

                'logo_toko' => null,
                'gunakan_logo_struk' => 'Ya',

                'footer_struk' => '*Terima Kasih Atas Kunjungan Anda*',

                'min_purchase_poin' => 50000,
                'poin_interval' => 10000,
                'poin_to_rupiah' => 1000,

                'status_pengajuan_toko' => 'proses',
                'alasan_ditolak' => null,

                'baudRate' => '9600',
                'dataBits' => '8',
                'parity' => 'none',
                'stopBits' => '1',
                'flowControl' => 'none',
                'port' => 'COM3',

                'format_timbangan' => 'ST,GS,+0000000kg',

                'urutan_timbang' => 'urut',

                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

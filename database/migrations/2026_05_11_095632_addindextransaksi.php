<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use app\Helpers\ApplyDatabase;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // CREATE INDEX idx_transaksi_id_barang_tanggal ON transaksi(id_barang, tanggal_transaksi);
// CREATE INDEX idx_transaksi_tipe_tanggal ON transaksi(tipe_transaksi, tanggal_transaksi);
        ApplyDatabase::applyToMainAndDynamicDatabases(function ($db) {
            Schema::connection($db)->table('transaksi', function (Blueprint $table) {
$table->index(['id_barang', 'tipe_transaksi', 'tanggal_transaksi'], 'idx_transaksi_id_tipe_tanggal');            });
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ApplyDatabase::applyToMainAndDynamicDatabases(function ($db) {
            Schema::connection($db)->table('transaksi', function (Blueprint $table) {
                //drop index
                $table->dropIndex('idx_transaksi_id_tipe_tanggal');
            });
        });
    }
};

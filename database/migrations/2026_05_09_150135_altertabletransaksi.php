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
        ApplyDatabase::applyToMainAndDynamicDatabases(function ($db) {
            Schema::connection($db)->table('transaksi', function (Blueprint $table) {
         //add harga_satuan, jumlah_satuan
         $table->integer('harga_satuan')->after('jumlah_barang');
         $table->integer('jumlah_satuan')->after('harga_satuan');
            });
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ApplyDatabase::applyToMainAndDynamicDatabases(function ($db) {
            Schema::connection($db)->table('transaksi', function (Blueprint $table) {
                //drop harga_satuan, jumlah_satuan
                $table->dropColumn('harga_satuan');
                $table->dropColumn('jumlah_satuan');
            });
        });
    }
};

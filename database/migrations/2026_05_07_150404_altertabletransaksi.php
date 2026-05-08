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
           //add tanggal transaksi
           $table->date('tanggal_transaksi')->after('keperluan_transaksi');
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
               //drop tanggal transaksi
               $table->dropColumn('tanggal_transaksi');
            });
        });
    }
};

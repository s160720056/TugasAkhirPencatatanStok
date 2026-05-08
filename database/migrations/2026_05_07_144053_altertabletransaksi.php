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
              //change id to id_barang
              $table->unsignedBigInteger('id_barang')->after('id_transaksi');
              
              $table->dropColumn('id');
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
              //change id_barang to id
              $table->unsignedBigInteger('id')->after('id_transaksi');
              $table->dropColumn('id_barang');
            });
        });
    }
};

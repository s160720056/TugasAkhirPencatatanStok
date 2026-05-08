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
            Schema::connection($db)->create('transaksi', function (Blueprint $table) {
                $table->id('id_transaksi');
                $table->integer('id_barang');
                $table->enum('tipe_transaksi', ['keluar', 'masuk'])->default('keluar');
                $table->integer('jumlah_barang');
                $table->string('keterangan_transaksi')->nullable();
                $table->string('diberikan_oleh')->nullable();
                $table->string('keperluan_transaksi')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ApplyDatabase::applyToMainAndDynamicDatabases(function ($db) {
            Schema::connection($db)->dropIfExists('transaksi');
        });
    }
};

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
            Schema::connection($db)->create('barang', function (Blueprint $table) {
                $table->id('id_barang');
                $table->string('nama_barang');
                $table->integer('kode_barang');
                $table->string('seri');
                $table->integer('stok_awal');
                $table->integer('stok_akhir');
                $table->dateTime('tanggal_input');
                $table->timestamps();
            });
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

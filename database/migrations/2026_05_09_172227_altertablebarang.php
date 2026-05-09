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
            Schema::connection($db)->table('barang', function (Blueprint $table) {
         $table->dropColumn('jumlah_satuan');
            });
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ApplyDatabase::applyToMainAndDynamicDatabases(function ($db) {
            Schema::connection($db)->table('barang', function (Blueprint $table) {
                $table->integer('jumlah_satuan')->after('stok_awal')->default(0);
             
            });
        });
    }
};

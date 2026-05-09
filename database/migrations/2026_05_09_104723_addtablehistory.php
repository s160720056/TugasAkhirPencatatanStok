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
            Schema::connection($db)->create('history_transaksi', function (Blueprint $table) {

                $table->bigIncrements('id_history_transaksi');

                // siapa melakukan
                $table->unsignedBigInteger('id_user')->nullable();

                // jenis aksi
                $table->enum('aksi', [
                    'create',
                    'update',
                    'delete'
                ]);

                // tabel yang diubah
                $table->string('nama_tabel');

                // id data utama
                $table->unsignedBigInteger('id_referensi');

                // data sebelum
               $table->json('before_data')->nullable();
$table->json('after_data')->nullable();

                // ip user
                $table->string('ip_address')->nullable();

                // user agent browser
                $table->text('user_agent')->nullable();

                // waktu aksi
                $table->timestamp('tanggal_history')->useCurrent();

                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ApplyDatabase::applyToMainAndDynamicDatabases(function ($db) {
            Schema::connection($db)->dropIfExists('history_transaksi');
                //drop history table
          
        });
    }
};

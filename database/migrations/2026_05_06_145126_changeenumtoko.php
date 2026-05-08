<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //drop table toko
        Schema::dropIfExists('toko');
        Schema::create('toko', function (Blueprint $table) {
            $table->bigIncrements('id_toko');

            $table->string('nama_toko', 191);
            $table->text('alamat_toko');
            $table->string('email_toko', 191);
            $table->string('tlp', 191);
            $table->string('nama_pemilik', 191);

            $table->timestamps();

            $table->string('ppn', 191)->nullable();

            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();

            $table->integer('toleransi_terlambat')->nullable();
            $table->integer('denda_keterlambatan');

            $table->string('lebar_kertas_struk', 191)->nullable();

            $table->enum('format_struk', ['1','2','3','4','5'])->default('1');

            $table->string('logo_toko', 191)->nullable();

            $table->enum('gunakan_logo_struk', ['Ya','Tidak'])->default('Tidak');

            $table->text('footer_struk');

            $table->integer('min_purchase_poin')->default(0);
            $table->integer('poin_interval')->default(0);
            $table->integer('poin_to_rupiah')->default(0);

            $table->enum('status_pengajuan_toko', [
                'proses',
                'diterima',
                'ditolak'
            ])->default('proses');

            $table->text('alasan_ditolak')->nullable();

            $table->string('baudRate', 191)->nullable();
            $table->string('dataBits', 191)->nullable();
            $table->string('parity', 191)->nullable();
            $table->string('stopBits', 191)->nullable();
            $table->string('flowControl', 191)->nullable();
            $table->string('port', 191)->nullable();

            $table->enum('format_timbangan', ['ST,GS,+0000000kg'])->nullable();

            $table->enum('urutan_timbang', ['urut','terbalik'])->default('urut');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
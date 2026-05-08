<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->id(); // id_toko (auto)

            $table->string('nama_toko');
            $table->text('alamat_toko')->nullable();
            $table->string('email_toko')->nullable();
            $table->string('tlp', 20)->nullable();
            $table->string('nama_pemilik')->nullable();

            // Jam operasional
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();

            // Keterlambatan
            $table->integer('toleransi_terlambat')->default(0); // menit
            $table->decimal('denda_keterlambatan', 12, 2)->default(0);

            // Struk
            $table->integer('lebar_kertas_struk')->default(58); // mm (58 / 80)
            $table->text('format_struk')->nullable();
            $table->string('logo_toko')->nullable();
            $table->boolean('gunakan_logo_struk')->default(true);
            $table->text('footer_struk')->nullable();

            // Poin
            $table->integer('min_purchase_poin')->default(0);
            $table->integer('poin_interval')->default(0);
            $table->decimal('poin_to_rupiah', 12, 2)->default(0);

            // Status pengajuan
            $table->enum('status_pengajuan_toko', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan_ditolak')->nullable();

            // Setting timbangan (serial)
            $table->integer('baudRate')->nullable();
            $table->integer('dataBits')->nullable();
            $table->string('parity')->nullable(); // none, even, odd
            $table->integer('stopBits')->nullable();
            $table->string('flowControl')->nullable();
            $table->string('port')->nullable();

            $table->string('format_timbangan')->nullable();
            $table->integer('urutan_timbang')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};

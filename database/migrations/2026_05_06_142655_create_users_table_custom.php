<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user'); // primary key + auto increment

            $table->string('nama_user');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('alamat_user')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('email')->unique();
            $table->string('gambar')->nullable();

            // status: 0=inactive,1=active,2=suspended (contoh)
            $table->enum('status_user', ['0','1','2'])->default('1');

            $table->boolean('ownership')->default(false);

            $table->unsignedBigInteger('id_hak_akses');

            $table->string('resetPin')->nullable();
            $table->string('activationPin')->nullable();

            $table->boolean('superadmin')->default(false);

            $table->timestamp('activationPin_expires')->nullable();
            $table->timestamp('resetPin_expires')->nullable();

            $table->rememberToken();

            // 2FA
            $table->text('two_factor_secret')->nullable();
            $table->boolean('two_factor_enabled')->default(false);
            $table->timestamp('two_factor_confirmed_at')->nullable();

            $table->timestamps();

            // optional index
            $table->index('id_hak_akses');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};

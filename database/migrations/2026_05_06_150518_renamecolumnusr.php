<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            // Rename kolom
            //hapus kolom status_user if exists
            $table->dropColumn('status_user');

        });
    }

    public function down(): void
    {
        
    }
};
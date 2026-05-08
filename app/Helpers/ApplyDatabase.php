<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ApplyDatabase
{
    /**
     * Apply migration to all dynamic databases.
     */
    public static function applyToMainAndDynamicDatabases(callable $callback): void
    {
        // Apply migration to the main database
        $callback(config('database.default'));

        // If the `toko` table doesn't exist yet (fresh install), skip dynamic databases
        if (!Schema::hasTable('toko')) {
            return;
        }

        // Fetch toko IDs
        $tokoIds = DB::table('toko')->where('id_toko', '!=', 0)->pluck('id_toko');

        if ($tokoIds->isEmpty()) {
            return;
        }

        foreach ($tokoIds as $id) {
            $dbName = env('DYNAMIC_DB') . $id;

            // Check if the database exists before applying the migration
            $databaseExists = DB::select("SHOW DATABASES LIKE '$dbName'");
            if (empty($databaseExists)) {
                continue;
            }

            // Set dynamic database connection
            config()->set('database.connections.dynamic.database', $dbName);
            DB::purge('dynamic');
            DB::reconnect('dynamic');

            // Apply migration to the dynamic database
            $callback('dynamic');
        }
    }
    public static function apply(callable $callback): void
    {
        // If the `toko` table doesn't exist yet, nothing to apply
        if (!Schema::hasTable('toko')) {
            return;
        }

        $tokoIds = DB::table('toko')->where('id_toko', '!=', 0)->pluck('id_toko');

        if ($tokoIds->isEmpty()) {
            return;
        }

        foreach ($tokoIds as $id) {
            $dbName = env('DYNAMIC_DB') . $id;
            
            // Cek apakah database ada sebelum menjalankan migrasi
            $databaseExists = DB::select("SHOW DATABASES LIKE '$dbName'");
            if (empty($databaseExists)) {
                continue;
            }
            
            // Set database connection secara dinamis
            config()->set('database.connections.dynamic.database', $dbName);
            DB::purge('dynamic');
            DB::reconnect('dynamic');
            
            // Jalankan migrasi yang diberikan dalam callback
            $callback('dynamic');
        }
    }
}

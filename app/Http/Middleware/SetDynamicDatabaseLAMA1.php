<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SetDynamicDatabase
{
    public function handle($request, Closure $next)
    {
        
        $id_toko = session('id_toko');

        if ($id_toko) {
            Config::set('database.connections.dynamic.database', env('DYNAMIC_DB') . $id_toko);

            DB::purge('dynamic');
            DB::reconnect('dynamic');
        }

        return $next($request);
    }
}

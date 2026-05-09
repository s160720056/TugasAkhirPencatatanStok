<?php 

namespace App\Helpers;

use App\Models\User;
use App\Models\HistoryTransaksi;

class AuditHelper
{
    public static function log(
        $aksi,
        $namaTabel,
        $idReferensi,
        $beforeData = null,
        $afterData = null
    ) {

        $username = session()->get('username');
        $user = User::where('username', $username)->first();

        HistoryTransaksi::create([
            'id_user' => $user->id_user,

            'aksi' => $aksi,

            'nama_tabel' => $namaTabel,

            'id_referensi' => $idReferensi,

            'before_data' => $beforeData,

            'after_data' => $afterData,

            'ip_address' => request()->ip(),

            'user_agent' => request()->userAgent(),

            'tanggal_history' => now(),
        ]);
    }
}
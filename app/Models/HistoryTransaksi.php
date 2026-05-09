<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryTransaksi extends Model
{
    protected $table = 'history_transaksi';

    protected $primaryKey = 'id_history_transaksi';

    protected $fillable = [
        'id_user',
        'aksi',
        'nama_tabel',
        'id_referensi',
        'before_data',
        'after_data',
        'ip_address',
        'user_agent',
        'tanggal_history',
    ];

    protected $casts = [
        'before_data' => 'array',
        'after_data' => 'array',
        'tanggal_history' => 'datetime',
    ];

    protected $connection='dynamic';
    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
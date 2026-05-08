<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $connection = 'mysql';

    protected $fillable = [
        'nama_user',
        'username',
        'password',
        'alamat_user',
        'telepon',
        'email',
        'gambar',
        'STATUS_USER',
        'id_hak_akses',
        'activationPin',
        'superadmin',
        'two_factor_secret',
        'two_factor_enabled',
        'two_factor_confirmed_at',
        'activationPin',
        'activationPin_expires',
        'resetPin',
        'resetPin_expires',
    ];
    protected $guarded = ['id_user', 'activationPin', 'resetPin'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'activationPin_expires' => 'datetime',
        'resetPin_expires'      => 'datetime',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setTwoFactorSecretAttribute($value)
    {
        $this->attributes['two_factor_secret'] = $value ? encrypt($value) : null;
    }

    public function getTwoFactorSecretAttribute($value)
    {
        return $value ? decrypt($value) : null;
    }
    /**
     * Override the getConnectionName method to use the dynamic connection.
     */

}

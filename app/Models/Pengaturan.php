<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Pengaturan extends Model
{
    // Specify the table name
    protected $table = 'toko';

    // Disable timestamps if they are not being used (optional)
    public $timestamps = true;

    // Set the primary key if it's not 'id' (which it isn't here)
    protected $primaryKey = 'id_toko';

    // Guarded fields (if any)
    protected $guarded = [];

    // Dynamically set the connection based on the session's id_toko
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $id_toko = Session::get('id_toko');
            if ($id_toko) {
                // Set the dynamic connection using the session's id_toko
                $model->setConnection('mysql');
            }
        });

        // Use this if you need to set the connection dynamically after retrieval
        static::retrieved(function ($model) {
            $id_toko = Session::get('id_toko');
            if ($id_toko) {
                // Ensure the model uses the correct connection after retrieval
                $model->setConnection('mysql');
            }
        });
    }
}

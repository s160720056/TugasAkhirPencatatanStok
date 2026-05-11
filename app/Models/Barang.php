<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
        use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    public $timestamps = true;
    protected $guarded = [];
    protected $connection = 'dynamic';

    // Set the connection dynamically at runtime
    // public static function boot()
    // {
    //     parent::boot();

    //     // Dynamically set the connection based on the session's id_toko
    //     static::creating(function ($model) {
    //         $id_toko = Session::get('id_toko');
    //         if ($id_toko) {
    //             // Set the dynamic connection using the session's id_toko
    //             $model->setConnection('dynamic');
    //         }
    //     });

    //     // You can also use `retrieved` or other events if necessary
    //     static::retrieved(function ($model) {
    //         $id_toko = Session::get('id_toko');
    //         if ($id_toko) {
    //             // Ensure the model uses the correct connection after retrieval
    //             $model->setConnection('dynamic');
    //         }
    //     });
    // }
}

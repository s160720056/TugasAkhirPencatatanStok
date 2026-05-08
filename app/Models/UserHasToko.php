<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class UserHasToko extends Model
{
    protected $table = 'user_has_toko';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
// protected $connection = 'mysql';
}
?>

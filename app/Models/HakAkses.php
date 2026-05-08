<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
class HakAkses extends Model
{
  protected $table = 'hak_akses';
  protected $primaryKey = 'id_hak_akses';
  public $timestamps = false;
  protected $guarded = [];
protected $connection='mysql';
}
?>

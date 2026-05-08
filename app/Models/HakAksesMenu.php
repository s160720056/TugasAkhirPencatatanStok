<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
class HakAksesMenu extends Model
{
  protected $table = 'hak_akses_menu';
  protected $primaryKey = 'id_hak_akses_menu';
  public $timestamps = false;
  protected $guarded = [];
protected $connection='mysql';
}
?>

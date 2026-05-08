<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
  protected $table = 'menu';
  protected $primaryKey = 'id_menu';
  public $timestamps = false;
  protected $guarded = [];
protected $connection='mysql';
public function __construct(array $attributes = [])
{
    // Dynamically set the database connection based on the toko ID
    if (isset($this->toko_id)) {
        $this->setConnection('mysql');
        $this->setDatabaseConnection();
    }

    parent::__construct($attributes);
}

// Method to set the database connection for the model dynamically
public function setDatabaseConnection()
{
    // Dynamically change the database connection based on toko ID
    $this->setTable('menu');
    $databaseName = env('DYNAMIC_DB') . $this->toko_id;  // Assume $this->toko_id is the toko ID
    DB::purge('mysql'); // Purge the default connection to avoid connection leaks
    config(['database.connections.mysql.database' => $databaseName]); // Set the DB to use toko_{id_toko}
}
}
?>

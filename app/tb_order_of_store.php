<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_order_of_store extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_order_user','id_store','order_code','total_order','time_order','order_status'
    ];
    protected $primaryKey = 'id_order_store';
    protected $table = 'tb_order_of_store';
      
}


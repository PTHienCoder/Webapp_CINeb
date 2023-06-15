<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_order_of_user extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user','order_code','method_payment','discount_order','total_order','time_order'
    ];
    protected $primaryKey = 'id_order_user';
    protected $table = 'tb_order_of_user';
      
}

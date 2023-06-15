<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_cart extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user','id_store','id_product','type_product','id_type_product','id_size_product','qty_product','check_item','order_code'
    ];
    protected $primaryKey = 'id_cart';
 	protected $table = 'tb_cart';
      
}

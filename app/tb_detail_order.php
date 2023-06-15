<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_detail_order extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_product','type_pro','name_type','name_size','qty_product','price_product','price_items','order_code','id_order_user','id_store'
    ];
    protected $primaryKey = 'id_details_order ';
    protected $table = 'tb_detail_order';
      
}

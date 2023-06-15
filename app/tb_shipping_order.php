<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_shipping_order extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user','name_shipping','email_user','desc_address_ship', 'address_ship','phone_order','type_address','id_order_user'
    ];
    protected $primaryKey = 'id_shipping_order';
    protected $table = 'tb_shipping_order';
      
}

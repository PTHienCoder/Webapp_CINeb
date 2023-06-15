<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_shipping extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user','name_shipping', 'phone_shipping','desc_address','address_shipping','type_shipping','check_shipping'
    ];
    protected $primaryKey = 'id_shipping';
    protected $table = 'tb_shipping';
      
}

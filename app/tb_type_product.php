<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_type_product extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_product','name_type_pro','image_type','qty_type_product','price_type_product'
    ];
    protected $primaryKey = 'id_type_pro';
 	protected $table = 'tb_type_product';
      
}

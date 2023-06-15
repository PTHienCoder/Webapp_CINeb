<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_size_product extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_product','id_type_pro','name_size','qty_size_product','price_size_product'
    ];
    protected $primaryKey = 'id_size_pro';
 	protected $table = 'tb_size_product';
      
}

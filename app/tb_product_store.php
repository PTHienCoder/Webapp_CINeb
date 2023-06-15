<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_product_store extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_cate_store','id_areas','id_store', 'name_product','price_product','discount_product','qty_product','type_product','title_type','desc_product','details_product','image_product','hastag_product','date_time','status'
    ];
    protected $primaryKey = 'id_product';
 	protected $table = 'tb_product_store';
      
}

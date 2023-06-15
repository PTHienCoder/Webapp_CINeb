<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_category_product extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_store','name_cate_product','desc_cate_product'
    ];
    protected $primaryKey = 'id_cate_product';
    protected $table = 'tb_category_product';
      
}

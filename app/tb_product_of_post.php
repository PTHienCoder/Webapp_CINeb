<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_product_of_post extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_post','id_product','id_store','id_user'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'tb_product_of_post';
      
}

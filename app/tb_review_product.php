<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_review_product extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user','id_product','content_review','rating_review','time_review','image_review'
    ];
    protected $primaryKey = 'id_review ';
 	protected $table = 'tb_review_product';
      
}

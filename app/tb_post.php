<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_post extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user','title_post', 'field_post','image_post','desc_post','detail_post','hastag_post','time_create'
    ];
    protected $primaryKey = 'id_post';
 	protected $table = 'tb_post';
      
}

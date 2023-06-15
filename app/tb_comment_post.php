<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_comment_post extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user','id_post','content','time_comment'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tb_comment_post';
      
}

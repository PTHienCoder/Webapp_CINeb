<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_follow_user extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user','id_friends', 'time_add'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'tb_follow_user';
      
}

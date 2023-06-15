<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_notification extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user_sender','idp','timeNoti', 'content', 'id_user'
    ];
    protected $primaryKey = 'idnoti';
 	protected $table = 'tb_notification';
      
}

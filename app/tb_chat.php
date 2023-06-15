<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_chat extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id_user', 'id_friends', 'content', 'time_chat'
    ];
    protected $primaryKey = 'id_chat';
 	protected $table = 'tb_chat';
}

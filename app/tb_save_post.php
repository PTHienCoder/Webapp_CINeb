<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_save_post extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id_user', 'id_post', 'time_save'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'tb_save_post';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_active_user extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id_user', 'id_product', 'id_post', 'content_active', 'type_active', 'time_active'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'tb_active_user';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_store extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'id_user','name_store', 'address_store','cmnd_user','phone_store','avt_store','desc_store','Category_store','type_store','time_add'
    ];
    protected $primaryKey = 'id_store';
 	protected $table = 'tb_store';
      
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_admin extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'email_admin',  'password', 'level_amdin'
    ];
    protected $primaryKey = 'id_admin';
 	protected $table = 'tb_admin';
 	
 	
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_field_project extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'image_field','name_field', 'desc_field'
    ];
    protected $primaryKey = 'id_field';
 	protected $table = 'tb_field_project';
      
}

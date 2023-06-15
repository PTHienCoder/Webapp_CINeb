<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_business_areas extends Model
{
    public $timestamps = false;
    protected $fillable = [
     'image_areas','name_areas', 'desc_areas'
    ];
    protected $primaryKey = 'id_areas';
 	protected $table = 'tb_business_areas';
      
}

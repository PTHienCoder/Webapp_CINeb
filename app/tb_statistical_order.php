<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_statistical_order extends Model
{
	
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id_store','order_date', 'sales', 'profit','quantity','total_order'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'tb_statistical_order';
}

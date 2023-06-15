<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name', 'type', 'maqh'
    ];
    protected $primaryKey = 'xaid';
 	protected $table = 'tbl_xaphuongthitran';
}

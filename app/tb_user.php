<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_user extends Model
{
    public $timestamps = false;
    // protected $guarded = []; nhung cot dong dung
    protected $fillable = [
     'name','email','password', 'image_user','phone_user','birthday','story','type_user','status','token'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'users';

}

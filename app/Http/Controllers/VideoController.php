<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_active_user;
use DB;
class VideoController extends Controller
{
    public function index(){


    $rows = tb_active_user::join('tb_post', 'tb_active_user.id_post', '=', 'tb_post.id_post')  
            ->select('tb_active_user.id_post', DB::raw('COUNT(id) as qty_active_post'), 'tb_post.title_post', 'tb_post.desc_post')
            ->groupBy('tb_active_user.id_post', 'tb_post.title_post' , 'tb_post.desc_post')
            ->orderBy('qty_active_post', 'desc')
            ->take(10)
            ->get();


    
     
    return view('user.page.video')->with('load_project_trend',$rows);
 }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_post;
use App\tb_comment_post;
use App\tb_active_user;
use DB;

class ExploreController extends Controller
{
   public function index(){

        $rows = tb_active_user::join('tb_post', 'tb_active_user.id_post', '=', 'tb_post.id_post')  
            ->select('tb_active_user.id_post', DB::raw('COUNT(id) as qty_active_post'), 'tb_post.title_post', 'tb_post.desc_post')
            ->groupBy('tb_active_user.id_post', 'tb_post.title_post' , 'tb_post.desc_post')
            ->orderBy('qty_active_post', 'desc')
            ->take(10)
            ->get();


    
    return view('user.page.explore')->with('load_project_trend',$rows);
 }


  public function Load_project_Explore(){

      $load_project = tb_post::join('tb_field_project', 'tb_post.field_post','=','tb_field_project.id_field')
      ->join('users', 'tb_post.id_user','=','users.id')
      ->select('tb_post.*', 'tb_field_project.name_field', 'users.image_user', 'users.name', 'users.id')
      ->orderby('tb_post.id_post','DESC')
      ->get();  

     if($load_project->count() >0){
        $output='';
         foreach($load_project as $key => $vid){
             $count_cm = tb_comment_post::where('id_post', $vid->id_post)->get()->count();
             $output .= '
                <div class="col-lg-4 col-md-6 col-sm-6"  style="margin-top: 30px;">
                    <div class="bp-mini bp-mini--img">
                                    <div class="bp-mini__thumbnail">

                                        <!--====== Image Code ======-->

                                        <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="'.url('/user_detail_post/'.$vid->id_post).'">

                                            <img class="aspect__img" src="'.asset('/uploadproject/'.$vid->image_post).'" alt=""></a>
                                        <!--====== End - Image Code ======-->
                                    </div>
                                    <div class="bp-mini__content">
                                        <div class="bp-mini__stat">

                                          
                                            <span class="bp-mini__stat-wrap">

                                                <span class="bp-mini__publish-date">
                                                <a><span>Time: '.$vid->time_create.'</span></a></span></span>

                                            <span class="bp-mini__stat-wrap">

                                                <span class="bp-mini__preposition">Field: </span>

                                                <span class="bp-mini__author">

                                                    <a>'.$vid->name_field.'</a></span></span>

                                            <span class="bp-mini__stat">

                                                <span class="bp-mini__comment">

                                                    <a ><i class="far fa-comments u-s-m-r-4"></i>

                                                        <span>'.$count_cm.'</span></a></span></span></div>
                                        <div class="bp-mini__category">

                                            <a>'.$vid->hastag_post.'</a></div>

                                        <span class="bp-mini__h1">

                                            <a href="'.url('/user_detail_post/'.$vid->id_post).'">'.$vid->title_post.'</a></span>
                                        <p class="bp-mini__p name_prouctxx">'.$vid->desc_post.'</p>
                                        <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="">Hagtag_trend</a>
                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="">Hagtag_trend1</a>

                                       </div>
                                    </div>
                                </div>           
                    
                 </div>
            ';
         }

     }else{

     }
     echo $output;


   
  
  }

}

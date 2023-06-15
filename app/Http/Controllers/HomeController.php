<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\tb_user;
use App\tb_business_areas;
use App\tb_post;

use App\tb_product_store;
use App\tb_review_product;
use App\tb_category_product;
use App\tb_type_product;
use App\tb_size_product;
use App\tb_store;
use App\tb_product_of_post;
use App\tb_save_post;
use Carbon\Carbon;
use App\tb_comment_post;
use App\tb_active_user;

class HomeController extends Controller
{
  public function index(){
    //  $load_project = DB::table('tb_post')
    // ->inRandomOrder()->get();   

    $rows = tb_active_user::join('tb_post', 'tb_active_user.id_post', '=', 'tb_post.id_post')  
            ->select('tb_active_user.id_post', DB::raw('COUNT(id) as qty_active_post'), 'tb_post.title_post', 'tb_post.desc_post')
            ->groupBy('tb_active_user.id_post', 'tb_post.title_post' , 'tb_post.desc_post')
            ->orderBy('qty_active_post', 'desc')
            ->take(10)
            ->get();


    
     return view('user.Home')
     ->with('load_project_trend',$rows);
  }



  public function load_post_page_home (){
     $load_project = tb_post::inRandomOrder()->get();
     if($load_project->count() >0){
        $output='';
         foreach($load_project as $key => $vid){
             $output .= '
                 <div class="card rowsss card_posts" >
                   <input type="hidden" value="'.$vid->id_post.'" class="id_post">
                        <!--image card start-->
                        <div class="image cardproject" style=" display: flex;justify-content: center;">
                           <img src="'.asset('/uploadproject/'.$vid->image_post).'" alt="post-img" class="rounded img-fluid">
                          <div class="details">
                            <h2><span>'.$vid->title_post.'</span></h2>
                            <p>'.$vid->desc_post.'.</p>
                            <div class="more more_post">
                              <a href="'.url('/user_detail_post/'.$vid->id_post).'" class="read-more">Read <span>More</span></a>
                            
                              <div class="icon-links" >
                               '; 
                                 if(Auth::user()){
                                     $tb_save = tb_save_post::where('id_user', Auth::user()->id)->where('id_post', $vid->id_post)->first();
                                        if($tb_save){
                                         $output.='<a class="btn_Nosave_post"><i class="mdi mdi-heart"></i></a> ';

                                         }else{
                                          $output.='<a class="btn_save_post"><i class="mdi mdi-heart-outline"></i></a> ';

                                         }

                                 }
                                            
                                 $output.='<a class="btn_detail_post"><i class="mdi mdi-eye"></i></a>

                              </div>
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



    public function load_post_trending(){




    }


  
}

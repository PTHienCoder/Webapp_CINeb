<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
class SearchController extends Controller
{
    public function index_search_product(Request $request){

       return view('user.shopping.Search_Product')
        ->with('key_search',$request->key_search);
    }

    public function load_product_key_search(Request $request){

         $output['data_result'] ='';
         $qty_result = 0;
        if($request->key_search != ""){

            $all_product = tb_product_store::where('name_product','LIKE','%'.$request->key_search.'%')->orwhere('hastag_product','LIKE','%'.$request->key_search.'%')
             ->orderBy('id_product', "DESC")->get();
         
            foreach($all_product as $key => $product){
                $qty_result ++;
                   $last_id = $product->id_product;

                  $count_rv = tb_review_product::where('id_product', $last_id)->count();

                   $product_sao = tb_review_product::where('id_product', $last_id) ->where('rating_review','>', 0)
                    ->avg('rating_review');
                     $output['data_result'] .= '

                       <div class="col-lg-3 col-md-6 col-sm-6 item_productxx">
                                 <div class="product-m">
                                         <div class="product-m__thumb">
                                            <a  class="aspect aspect--bg-grey aspect--square u-d-block" href="'.url('/detail_products/'.$product->id_product).'">

                                             <img class="aspect__img" src="'.asset('/uploadproduct/'.$product->image_product).'
                                                 " alt=""></a>
                                            
                                               <div class="product-m__add-cart">
                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
                                                 <a class="btn--e-brand view_detail_modal">View</a>
                                                </div>
                                           </div>
                                    <div class="product-m__content">
                                        <span class="product-o__name" style =" display: block; height: 42px;">
                                      <a href="'.url('/detail_products/'.$product->id_product).'" class="name_prouctxx">'.$product->name_product.' </a>
                                       </span> 
                                        <span class="product-o__price"> '; 

                                        if($product->type_product == 0){
                                               $output['data_result'].='<p class="text_price">'.$product->price_product.'.000đ</p> ';

                                        }else if($product->type_product == 1){
                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
                                               $output['data_result'].='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 

                                        }else if($product->type_product == 2){
                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                                               $output['data_result'].='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 
                                        }
                         
                                  $output['data_result'].=' 
                                      
                                       
                                        </span>
                                        <br>

                                            <div class="product-m__rating gl-rating-style">
                                            ';

                                             for ($i = 1; $i <= $product_sao; $i++){   
                                                   $output['data_result'].= ' 
                                                  <i class="fas fa-star"></i> 
                                                  ';
                                                }
                                                if($product_sao < round($product_sao)){
                                                     $output['data_result'].= ' 
                                                  <i class="fas fa-star-half-alt"></i> 
                                                  ';
                                              }

                                   $output['data_result'] .='<span class="product-m__review">('.$count_rv.')</span>
                                             <span class="product-o__discount">  </div>

                                   </div>

                               </div>
                          </div>

                      ';
                  }

         }else{
            $output['data_result'] .='';
         }

       $output['Qty_result'] = "Found ".$qty_result." results";
         echo json_encode($output);
    }


   public function load_product_search_ajax(Request $request){

        $id_user = Auth::user()->id;

         $output['data_result'] ='';
        $output['Qty_result'] = 0;
        if($request->key_search != ""){

            $all_product = tb_product_store::where('name_product','LIKE','%'.$request->key_search.'%')
            ->orwhere('hastag_product','LIKE','%'.$request->key_search.'%')->take(3)
            ->orderBy('id_product', "DESC")
            ->get();

             $qty = tb_product_store::where('name_product','LIKE','%'.$request->key_search.'%')
            ->orwhere('hastag_product','LIKE','%'.$request->key_search.'%')
            ->count();
               $output['Qty_result'] = $qty;
            foreach($all_product as $key => $product){

                  $output['data_result'] .= '  
                       <a href="'.url('/detail_products/'.$product->id_product).'" class="dropdown-item notify-item " id="item_searchxxx">            
                        <div class="d-flex">
                          <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
                           <img class="d-flex me-2" src="'.asset('/uploadproduct/'.$product->image_product).'"height="32">
                           <div class="w-100">
                           <h5 class="m-0 font-14">'.$product->name_product.'</h5>
                            <span class="font-12 mb-0">'.$product->hastag_product.'</span>
                           </div>
                        </div>
                       </a>';
                
                  }
  
         
         }else{

          $active = tb_active_user::where('type_active', "Search_Product")
             ->where('id_user', $id_user)
             ->select('tb_active_user.id_product')
             ->groupBy('tb_active_user.id_product')
             ->orderby('id','DESC')->take(3)->get();

            foreach($active as $key => $active){
               $produc = tb_product_store::where('id_product', $active->id_product)->first();

                  $output['data_result'] .= '  
                    <div class="d-flex id_remove" >
                       <a href="'.url('/detail_products/'.$produc->id_product).'" class="dropdown-item notify-item " id="item_searchxxx">            
                        <div class="d-flex">
                          <input class="id_active" type="hidden" value="'.$active->id.'" >
                          <input class="id_productss" type="hidden" value="'.$produc->id_product.'" >
                           <img class="d-flex me-2" src="'.asset('/uploadproduct/'.$produc->image_product).'"height="32">
                           <div class="w-100">
                           <h5 class="m-0 font-14">'.$produc->name_product.'</h5>
                            <span class="font-12 mb-0">'.$produc->hastag_product.'</span>
                           </div>
                          
                        </div>
                       </a> 
                      <button style=" margin-right: 10px" type="button" class="btn-close btn-sm remove_active" aria-label="Close"></button>
                    </div>'
                       ;
                
                  }
         }


         echo json_encode($output);
    }


/////////////////////////////////// seacrch post ///////////////////////


    public function index_search_post(Request $request){
       return view('user.project.Search_Post')
        ->with('key_search',$request->key_search);
    }

    public function load_post_key_search(Request $request){

         $output['data_result'] ='';
         $qty_result = 0;
        if($request->key_search != ""){
  
        $load_project = tb_post::join('tb_field_project', 'tb_post.field_post','=','tb_field_project.id_field')
          ->join('users', 'tb_post.id_user','=','users.id')
          ->select('tb_post.*', 'tb_field_project.name_field', 'users.image_user', 'users.name', 'users.id')
          ->where('title_post','LIKE','%'.$request->key_search.'%')->orwhere('hastag_post','LIKE','%'.$request->key_search.'%')
          ->orderby('tb_post.id_post','DESC')
          ->get();

           foreach($load_project as $key => $vid){
            $qty_result ++;
             $count_cm = tb_comment_post::where('id_post', $vid->id_post)->get()->count();                

                $output['data_result'] .=' 
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
                                        <p class="bp-mini__p">'.$vid->desc_post.'</p>
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
            $output['data_result'] .='';
         }

       $output['Qty_result'] = "Found ".$qty_result." results";
         echo json_encode($output);
    }


   public function load_post_search_ajax(Request $request){

        $id_user = Auth::user()->id;

         $output['data_result'] ='';
        $output['Qty_result'] = 0;
        if($request->key_search != ""){

            $all_product = tb_post::where('title_post','LIKE','%'.$request->key_search.'%')
            ->orwhere('hastag_post','LIKE','%'.$request->key_search.'%')->take(3)
            ->get();

             $qty = tb_post::where('title_post','LIKE','%'.$request->key_search.'%')
            ->orwhere('hastag_post','LIKE','%'.$request->key_search.'%')
            ->count();
               $output['Qty_result'] = $qty;
            foreach($all_product as $key => $product){

                  $output['data_result'] .= '  
                       <a href="'.url('/user_detail_post/'.$product->id_post).'" class="dropdown-item notify-item " id="item_searchxxx">            
                        <div class="d-flex">
                          <input class="id_post" type="hidden" value="'.$product->id_post.'" >
                           <img class="d-flex me-2" src="'.asset('/uploadproject/'.$product->image_post).'"height="32">
                           <div class="w-100">
                           <h5 class="m-0 font-14">'.$product->title_post.'</h5>
                            <span class="font-12 mb-0">'.$product->hastag_post.'</span>
                           </div>
                        </div>
                       </a>';
                
                  }
  
         
         }else{
          $active = tb_active_user::where('type_active', "Search_Post")
            ->where('id_user', $id_user)
            ->select('tb_active_user.id_post')
            ->groupBy('tb_active_user.id_post')
             ->orderby('id','DESC')->take(3)->get();

            foreach($active as $key => $active){
               $produc = tb_post::where('id_post', $active->id_post)->first();

                  $output['data_result'] .= '
                    <div class="d-flex id_remove" >
                       <a href="'.url('/user_detail_post/'.$produc->id_post).'" class="dropdown-item notify-item " id="item_searchxxx">            
                        <div class="d-flex">
                         
                           <img class="d-flex me-2" src="'.asset('/uploadproject/'.$produc->image_post).'"height="32">
                           <div class="w-100">                          
                           <input class="id_active" type="hidden" value="'.$active->id.'" >
                           <input class="id_post" type="hidden" value="'.$produc->id_post.'" >
                           <h5 class="m-0 font-14">'.$produc->title_post.'</h5>
                            <span class="font-12 mb-0">'.$produc->hastag_post.'</span>
                           </div>
                          
                        </div>

                       </a>

                        <button style=" margin-right: 10px" type="button" class="btn-close btn-sm remove_active" aria-label="Close"></button>
                     </div>'
                       ;
                
                  }
         }


         echo json_encode($output);
    }

 public function add_product_active_shopping(Request $request){
    $id_user = Auth::user()->id;

            $idusser = Auth::user()->id;  

             $active = new tb_active_user();
             $active->id_user =$idusser;

             $active->id_product =$request->id_productss;
             $active->id_post =$request->id_post;
             $active->content_active = $request->content_key;
             $active->type_active = $request->key_active;
             $mytime = Carbon::now('Asia/Ho_Chi_Minh');
             $active->time_active =$mytime;
           
             $active->save();
  }

  public function remove_active_user(Request $request){
            if($request->type =="post"){
                
            tb_active_user::where('id_post', $request->id)->where('type_active', "Search_Post")->delete();

            }else if($request->type=="product") {

            tb_active_user::where('id_product', $request->id)->where('type_active', "Search_Product")->delete();
            }
  
  }


  
}

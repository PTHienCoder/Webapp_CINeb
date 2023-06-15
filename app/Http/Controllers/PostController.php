<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\tb_field_project;
use Session;
use Carbon\Carbon;
use DB;
use App\tb_user;
use App\tb_business_areas;
use App\tb_post;

use Str;
use App\tb_product_store;
use App\tb_review_product;
use App\tb_category_product;
use App\tb_type_product;
use App\tb_size_product;
use App\tb_store;
use App\tb_product_of_post;
use App\tb_comment_post;
use App\tb_follow_user;
use App\tb_save_post;
use App\tb_notification;


class PostController extends Controller
{
///////////////////////////////////////////  add post      /////////////////////////////////////////////// 
    public function AddProject (){
      
        $load_field = tb_field_project::orderBy('id_field','DESC')->get();

         return view('user.project.add_video_project')->with('load_field',$load_field );
    }

    public function savepost (Request $request){

         $tb_post = new tb_post();
         $tb_post->id_user = Auth::user()->id;
         $tb_post->title_post = $request->title_post;
         $tb_post->field_post = $request->field_post;   

         $tb_post->desc_post = $request->overview_post;
         $tb_post->detail_post = $request->details_post;

         $tb_post->hastag_post = $request->Input_Hastag_post;
        

         $mytime = Carbon::now('Asia/Ho_Chi_Minh');
         $tb_post->time_create = $mytime;
    
          $get_image = $request->file('file');

          $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
          $path = public_path('uploadproject/'.$get_name_image);
          Image::make($get_image->getRealPath())->fit(939, 800)->save($path);
          $tb_post->image_post = $get_name_image;
 
          $tb_post->save();




        $output['id_post'] = $tb_post->id_post;
    
        echo json_encode($output);
  
    }
    public function remove_post($id_post){
     
        $tb = tb_post::find($id_post);

        if($tb->image_post !=null){      
           unlink('uploadproject/'.$tb->image_post);  
        }

        $tb->delete();

      return redirect('/');
    }

    public function edit_post($id_post){
     
      $load_field = tb_field_project::orderBy('id_field','DESC')->get();
       $load_post = tb_post::where('id_post', $id_post)->orderBy('id_post','DESC')->get();

     return view('user.project.Edit_Project')->with('load_field', $load_field)->with('load_post', $load_post);
    }

    public function Save_edit (Request $request){

         $tb_post = tb_post::find($request->id_post);
         // dd(Auth::user()->id);
         $tb_post->id_user = Auth::user()->id;
         $tb_post->title_post = $request->title_post;
         $tb_post->field_post = $request->field_post;   

         $tb_post->desc_post = $request->overview_post;
         $tb_post->detail_post = $request->details_post;

         $tb_post->hastag_post = $request->Input_Hastag_post;
        

         $mytime = Carbon::now('Asia/Ho_Chi_Minh');
         $tb_post->time_create = $mytime;
         
          $get_image = $request->file('file');

          if($get_image != null){
          $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
          $path = public_path('uploadproject/'.$get_name_image);
          Image::make($get_image->getRealPath())->fit(939, 800)->save($path);
          $tb_post->image_post = $get_name_image;
 
          }
  
          $tb_post->save();

          $output['id_post'] = $tb_post->id_post;
    
        echo json_encode($output);

  
    }



///////////////////////////////// save post ///////////////////////////////




    
  public function user_save_post(Request $request){

        $mytime = Carbon::now('Asia/Ho_Chi_Minh');

         $tb_save = new tb_save_post();
         $tb_save->id_user = Auth::user()->id;
         $tb_save->id_post = $request->id_post;
         $tb_save->time_save = $mytime;
         $tb_save->save();

              $po = tb_post::select('id_user')->where('id_post', $request->id_post)->first();
             $noti = new tb_notification();
             $noti->id_user_sender = Auth::user()->id;
             $noti->idp = $request->id_post;
             $mytime = Carbon::now('Asia/Ho_Chi_Minh');
             $noti->timeNoti =$mytime;
             $noti->content ="Vừa lưu bài dự án của bạn !";
             $noti->id_user = $po->id_user;       
             $noti->save();
   
  }

  public function user_Nosave_post(Request $request){
         $tb_save = tb_save_post::where('id_user', Auth::user()->id)->where('id_post', $request->id_post)->delete();
  }

  public function user_detail_post($id_post){
      $load_project = tb_post::where('tb_post.id_post', $id_post)
      ->join('tb_field_project', 'tb_post.field_post','=','tb_field_project.id_field')
      ->join('users', 'tb_post.id_user','=','users.id')
      ->select('tb_post.*', 'tb_field_project.name_field', 'users.image_user', 'users.name', 'users.id')->get();   

        $count_pro = tb_product_of_post::where('tb_product_of_post.id_post', $id_post)->get()->count();   
        $count_cm = tb_comment_post::where('id_post', $id_post)->get()->count(); 
    
     return view('user.project.Detail_post')
      ->with('load_project',$load_project)
      ->with('count_cm',$count_cm)
      ->with('count_pro',$count_pro);
  }




  public function load_Product_of_Post_Right__Details(Request $request){

     $all_product = tb_product_of_post::join('tb_product_store', 'tb_product_of_post.id_product','=','tb_product_store.id_product')
     ->select('tb_product_of_post.*','tb_product_store.id_product','tb_product_store.type_product','tb_product_store.name_product','tb_product_store.image_product', 
        'tb_product_store.price_product')
     ->where('tb_product_of_post.id_post', $request->id_post)
     ->orderby('tb_product_of_post.id','DESC')->get();      


        $output = ''; 
            $count = $all_product->count();
            if($count>0){
              foreach($all_product as $key => $qtypro){ 
              
                $output .= '

                      <tr class = "click_itemcart_layout">
                       <input type="hidden" min="1" value="'.$qtypro->id_product.'" class="id_proxx">       
                         <td>
                           <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body fw-semibold">
                         <img src="'.asset('/uploadproduct/'.$qtypro->image_product).'"class="img-fluid avatar-md rounded-circle"></a>
                         <p class="m-0 d-inline-block align-middle">
                         <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body fw-semibold">'.$qtypro->name_product.'</a>
                          <br>   ';

                  if($qtypro->type_product == 0){
                     $output .= '<span> '.$qtypro->price_product.'.000đ</span>
                         </p>
                         </td>
                    


                      </tr>          
                    ';

                  }else if($qtypro->type_product == 1){
                       $min = tb_type_product::where('id_product', $qtypro->id_product)->min('price_type_product');
                       $max = tb_type_product::where('id_product', $qtypro->id_product)->max('price_type_product');
                     $output .= '   
                        <span>'.$min.'.000đ - '.$max.'.000đ</span><br>
                         </p>
                         </td>
                      


                      </tr>          
                    ';

                  }else if($qtypro->type_product == 2){
                       $min = tb_size_product::where('id_product', $qtypro->id_product)->min('price_size_product');
                        $max = tb_size_product::where('id_product', $qtypro->id_product)->max('price_size_product');
                     $output .= '   
                        <span> '.$min.'.000đ - '.$max.'.000đ</span><br>   
                         </p>
                         </td>
                     


                      </tr>          
                    ';
                  }
                

               }
       

            }else{
              $output.='
                  <tr>
                      <td colspan="4">There are no products in the Post.</td>
                                               
                   </tr>
                   ';

            }
       
      
        echo $output;
  

         
}


/////////////////// add_product_for_post ////////////////////////////////

public function add_product_for_post(Request $request, $id_post){
       $id_store = null;
      if (Auth::user()->type_user ==1) {
       $store = tb_store::where('id_user', Auth::user()->id)->first();
       $id_store = $store->id_store;
      }
   

       return view('user.project.Add_Products_Post')->with('id_post',$id_post )->with('id_store',$id_store );

    }
    




public function add_product_to_post(Request $request){

   $check = tb_product_of_post::where('id_post', $request->id_post)->where('id_product',$request->id_product)->get()->count();

    if ( $check > 0) {
        $output['chek'] = 0;
    
        echo json_encode($output);
       
    }else{

         $store = tb_product_store::select('id_product')->where('id_product', $request->id_product)->first();

         $tb_product_of_post = new tb_product_of_post();
         $tb_product_of_post->id_post = $request->id_post;
         $tb_product_of_post->id_product = $request->id_product;   
         $tb_product_of_post->id_user = Auth::user()->id;
         $tb_product_of_post->id_store = $store->id_store;
         $tb_product_of_post->save();

         $output['chek'] = 1;
    
        echo json_encode($output);
     }

         
  }

public function load_qty_product_of_Post(Request $request){
         $qty_pro = tb_product_of_post::where('id_post', $request->id_post)->get()->count();         

         $output['Qty_pro'] = $qty_pro;
    
        echo json_encode($output);
  

         
  }

public function Remove_item_Pro_post(Request $request){

      $del = tb_product_of_post::find($request->id_item);
      $del->delete();
  }

public function load_Product_of_Post_Right(Request $request){


     $all_product = tb_product_of_post::join('tb_product_store', 'tb_product_of_post.id_product','=','tb_product_store.id_product')
     ->select('tb_product_of_post.*','tb_product_store.id_product','tb_product_store.type_product','tb_product_store.name_product','tb_product_store.image_product', 
        'tb_product_store.price_product')
     ->where('tb_product_of_post.id_post', $request->id_post)
     ->orderby('tb_product_of_post.id','DESC')->get();      


        $output = ''; 
            $count = $all_product->count();
            if($count>0){
              foreach($all_product as $key => $qtypro){ 
              
                $output .= ' 
                      <tr class = "click_itemcart_layout">
                       <input type="hidden" min="1" value="'.$qtypro->id_product.'" class="id_proxx">       
                         <td>
                         <img src="'.asset('/uploadproduct/'.$qtypro->image_product).'"class="img-fluid avatar-md rounded-circle">
                         <p class="m-0 d-inline-block align-middle">
                         <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body fw-semibold">'.$qtypro->name_product.'</a>
                          <br>   ';

                  if($qtypro->type_product == 0){
                     $output .= '<span> '.$qtypro->price_product.'.000đ</span>
                         </p>
                         </td>
                        <td style="width:20px">
                             <input type="hidden" id="id_item" value="'.$qtypro->id.'">
                            <i class ="mdi mdi-close remove_item"></i>
                         </td>


                      </tr>          
                    ';

                  }else if($qtypro->type_product == 1){
                       $min = tb_type_product::where('id_product', $qtypro->id_product)->min('price_type_product');
                       $max = tb_type_product::where('id_product', $qtypro->id_product)->max('price_type_product');
                     $output .= '   
                        <span>'.$min.'.000đ - '.$max.'.000đ</span><br>
                         </p>
                         </td>
                        <td  style="width:20px">
                         <input type="hidden" id="id_item" value="'.$qtypro->id.'">
                      <i class ="mdi mdi-close remove_item"></i>
                         </td>


                      </tr>          
                    ';

                  }else if($qtypro->type_product == 2){
                       $min = tb_size_product::where('id_product', $qtypro->id_product)->min('price_size_product');
                        $max = tb_size_product::where('id_product', $qtypro->id_product)->max('price_size_product');
                     $output .= '   
                        <span> '.$min.'.000đ - '.$max.'.000đ</span><br>   
                         </p>
                         </td>
                         <td style="width:20px">
                          <input type="hidden" id="id_item" value="'.$qtypro->id.'">
                         <i class ="mdi mdi-close remove_item"></i>
                         </td>


                      </tr>          
                    ';
                  }
                

               }
       

            }else{
              $output.='
                  <tr>
                      <td colspan="4">There are no products in the Post.</td>
                                               
                   </tr>
                   ';

            }
       
      
        echo $output;
  

         
}
public function load_more_product_add_post(Request $request){

          $pro_post = tb_product_of_post::select('id_product')
          ->where('id_post', $request->id_post)->get(); 

         $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
         ->whereNotIn('id_product', $pro_post)
        ->orderby('id_product','DESC')->get();         
  
       $output ='';
       if(!$all_product->isEmpty()){

                foreach($all_product as $key => $product){
                   $last_id = $product->id_product;

                  $count_rv = tb_review_product::where('id_product', $last_id)->count();

                   $product_sao = tb_review_product::where('id_product', $last_id) ->where('rating_review','>', 0)
                    ->avg('rating_review');
                    $output .= '

                       <div class="col-lg-3 col-md-6 col-sm-6">
                                 <div class="product-m">
                                         <div class="product-m__thumb">
                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.url('/detail_products/'.$product->id_product).'">

                                             <img class="aspect__img" src="'.asset('/uploadproduct/'.$product->image_product).'
                                                 " alt=""></a>
                                            
                                               <div class="product-m__add-cart">
                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
                                                 <a class="btn--e-brand add_product_to_post">Add To Post</a>
                                                </div>
                                           </div>
                                    <div class="product-m__content">
                                        <span class="product-o__name" style =" display: block; height: 42px;">
                                      <a class="name_prouctxx">'.$product->name_product.' </a>
                                       </span> 
                                        <span class="product-o__price"> '; 

                                        if($product->type_product == 0){
                                              $output.='<p class="text_price">'.$product->price_product.'.000đ</p> ';

                                        }else if($product->type_product == 1){
                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 

                                        }else if($product->type_product == 2){
                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 
                                        }
                         
                                 $output.=' 
                                      
                                       
                                        </span>
                                        <br>

                                            <div class="product-m__rating gl-rating-style">
                                            ';

                                             for ($i = 1; $i <= $product_sao; $i++){   
                                                  $output.= ' 
                                                  <i class="fas fa-star"></i> 
                                                  ';
                                                }
                                                if($product_sao < round($product_sao)){
                                                    $output.= ' 
                                                  <i class="fas fa-star-half-alt"></i> 
                                                  ';
                                              }

                                  $output .='<span class="product-m__review">('.$count_rv.')</span>
                                             <span class="product-o__discount">  </div>

                                   </div>

                               </div>
                          </div>

                      ';
                  }



       }else{

            $output .= '';
       }

         // <a class="btn--e-brand" onclick="view_detail_modal(this.id);" id="'.$product->id_product.'">View</a>


        echo $output;

         
  }

public function load_product_add_post_store(Request $request){
    

         $pro_post = tb_product_of_post::select('id_product')
          ->where('id_post', $request->id_post)->get(); 

         $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
         ->where('id_store', $request->id_store)
         ->whereNotIn('id_product', $pro_post)
         ->orderby('id_product','DESC')->get();         
  
       $output ='';
       if(!$all_product->isEmpty()){

                foreach($all_product as $key => $product){
                   $last_id = $product->id_product;

                  $count_rv = tb_review_product::where('id_product', $last_id)->count();

                   $product_sao = tb_review_product::where('id_product', $last_id) ->where('rating_review','>', 0)
                    ->avg('rating_review');
                    $output .= '

                       <div class="col-lg-3 col-md-6 col-sm-6">
                                 <div class="product-m">
                                         <div class="product-m__thumb">
                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.url('/detail_products/'.$product->id_product).'">

                                             <img class="aspect__img" src="'.asset('/uploadproduct/'.$product->image_product).'
                                                 " alt=""></a>
                                            
                                               <div class="product-m__add-cart">
                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
                                                 <a class="btn--e-brand add_product_to_post">Add To Post</a>
                                                </div>
                                           </div>
                                    <div class="product-m__content">
                                        <span class="product-o__name" style =" display: block; height: 42px;">
                                      <a class="name_prouctxx">'.$product->name_product.' </a>
                                       </span> 
                                        <span class="product-o__price"> '; 

                                        if($product->type_product == 0){
                                              $output.='<p class="text_price">'.$product->price_product.'.000đ</p> ';

                                        }else if($product->type_product == 1){
                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 

                                        }else if($product->type_product == 2){
                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 
                                        }
                         
                                 $output.=' 
                                      
                                       
                                        </span>
                                        <br>

                                            <div class="product-m__rating gl-rating-style">
                                            ';

                                             for ($i = 1; $i <= $product_sao; $i++){   
                                                  $output.= ' 
                                                  <i class="fas fa-star"></i> 
                                                  ';
                                                }
                                                if($product_sao < round($product_sao)){
                                                    $output.= ' 
                                                  <i class="fas fa-star-half-alt"></i> 
                                                  ';
                                              }

                                  $output .='<span class="product-m__review">('.$count_rv.')</span>
                                             <span class="product-o__discount">  </div>

                                   </div>

                               </div>
                          </div>

                      ';
                  }



       }else{

            $output .= '';
       }

         // <a class="btn--e-brand" onclick="view_detail_modal(this.id);" id="'.$product->id_product.'">View</a>


        echo $output;

         
  }

  ////////////////////////////////// COMMENT POST /////////////////////////////


public function post_commen_post(Request $request){
    $id_user = Auth::user()->id;
         
        if($id_user == null){
          $output['id_usersxx'] = "null";
            echo json_encode($output); 
        }else{

            $idusser = Auth::user()->id;  

             $review = new tb_comment_post();
             $review->id_user =$idusser;
             $review->id_post =$request->id_post;
             $review->content =$request->content_review;

             $mytime = Carbon::now('Asia/Ho_Chi_Minh');
             $review->time_comment =$mytime;
               
             $review->save();
            $output['id_usersxx'] = "exist";
            echo json_encode($output); 
                
           

        }
            
         
  }
    public function Load_qty_comment_post(Request $request){

     $count_cm = tb_comment_post::where('id_post', $request->id_post)->get()->count(); 
      $output['Qty_comment'] = $count_cm;
      echo json_encode($output); 
    
  }


   public function load_comment_post(Request $request){
         $id_post =$request->id_post;



         $all_review = tb_comment_post::where('id_post', $id_post)
         ->join('users','users.id','=','tb_comment_post.id_user')
         ->orderby('tb_comment_post.id','DESC')->get();         


       $output ='';
       if(!$all_review->isEmpty()){

                foreach($all_review as $key => $rview){
                   $last_id = $rview->id_review;
                     $output .= '
                           <div class="review-o u-s-m-b-15">
                                   <div class="review-o__info u-s-m-b-8">

                                     <span class="review-o__name"> 
                                     <img src="'.asset('/uploads/profile/'.$rview->id_user.'/'.$rview->image_user).'" alt="image" class="img-fluid avatar-xs rounded-circle">  
                                     &nbsp;  '.$rview->name.'</span>

                                                <span class="review-o__date">'.$rview->time_comment.'</span>
                                        </div>
                                          <div class="review-o__rating gl-rating-style u-s-m-b-8">
                              </div>
                                <p class="review-o__text">'.$rview->content.'</p>
                              </div>
                    
                               ';
                  }

                    

       }else{

            $output .= '';
       }


        echo $output;

         
  }

}

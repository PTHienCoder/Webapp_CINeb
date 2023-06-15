<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\tb_store;
use Session;
use App\users;
use App\tb_product_store;
use App\tb_business_areas;
use App\tb_review_product;
use App\tb_category_product;
use App\tb_type_product;
use App\tb_size_product;
use DB;
use Carbon\Carbon;
class Shoppingcontroller extends Controller
{

   

  public function detail_products($id_pro){
    
  
    $product = tb_product_store::where('id_product', $id_pro)
    ->join('tb_store','tb_product_store.id_store','=','tb_store.id_store')
    ->join('tb_category_product','tb_category_product.id_cate_product','=','tb_product_store.id_cate_store')
    ->join('tb_business_areas','tb_product_store.id_areas','=','tb_business_areas.id_areas')->get();
     

    $producsss = tb_product_store::where('id_product', $id_pro)->get();
   
    return view('user.shopping.detail_product')
    ->with('count_pro_store', $producsss->count())
    ->with('product', $product);
  }

  public function Pages_store_product($id_store){
    $store = tb_store::where('id_store', $id_store)->get();
     $producsss = tb_product_store::select('id_product')->where('id_store', $id_store)->get();

     $cate = tb_category_product::select('id_cate_product', 'name_cate_product')
                 ->where('id_store', $id_store)->get();
      return view('user.shopping.store_pages') 
     ->with('cate', $cate)
     ->with('pro_qtyxx', $producsss->count())
     ->with('store', $store);
  }


 public function index(){
    $cate = tb_business_areas::orderby('id_areas', 'DESC')->get();
    // $product = tb_product_store::get();
    return view('user.page.shopping')
    ->with('cate', $cate);
  }



 public function load_products_of_store(Request $request){
        $data = $request->all();
         $id_store = $request->id_store;

         if($data['id']>0){
         $all_product = tb_product_store::where('id_store', $id_store)->where('id_product','<',$data['id'])->orderby('id_product','DESC')->take(24)->get(); 

         }else{
           // dd($id_store);
          $all_product= tb_product_store::where('id_store', $id_store)->orderby('id_product','DESC')->take(24)->get();         
         }

       $output ='';
       if(!$all_product->isEmpty()){

                foreach($all_product as $key => $product){
                   $last_id = $product->id_product;

                   $count_rv = tb_review_product::where('id_product', $last_id)->count();
                   $product_sao = tb_review_product::where('id_product', $last_id) ->where('rating_review','>', 0)->avg('rating_review');

                     $output .= '

                       <div class="col-lg-3 col-md-6 col-sm-6">
                                 <div class="product-m">
                                         <div class="product-m__thumb">
                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.url('/detail_products/'.$product->id_product).'">

                                             <img class="aspect__img" src="'.asset('/uploadproduct/'.$product->image_product).'
                                                 " alt=""></a>
                                                <div class="product-m__quick-look">

                                                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
                                                <div class="product-m__add-cart">
                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
                                                 <a class="btn--e-brand view_detail_modal">View</a>
                                                </div>
                                           </div>
                                    <div class="product-m__content">
                                        <span class="product-o__name" style =" display: block; height: 42px;">
                                        <a class="name_prouctxx" href="'.url('/detail_products/'.$product->id_product).'">'.$product->name_product.' </a>
                                       </span> 
                                        <span class="product-o__price"> '; 

                                        if($product->type_product == 0){
                                              $output.='<p class="text_price">'.$product->price_product.'.000đ</small></p> ';

                                        }else if($product->type_product == 1){
                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</small></p>'; 

                                        }else if($product->type_product == 2){
                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</small></p>'; 
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

                        $output .='  
                                 <div class="abcd" style="display: flex;justify-content: center;margin-top: 15px;" >
                                 <input type="hidden" class="id_store" value="'.$id_store.'">
                                    <button type="button" class="btn btn-info btn-sm" data-id="'.$last_id.'" id="load_more_button" >load more</button>
                                   </div>     
                                                            
                         ';

       }else{

            $output .= '';
       }


        echo $output;



 }

  public function load_products_category_of_store(Request $request){
        $data = $request->all();
         $id_store = $request->id_store;
         $idcate = $request->idcate;

         if($data['id']>0){
           
          $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
        ->where('id_store', $id_store)
         ->where('id_cate_store', $idcate)
         ->where('id_product','<',$data['id'])
         ->orderby('id_product','DESC')->take(24)->get(); 

         }else{

         $all_product= tb_product_store::where('id_store', $id_store)->where('id_cate_store', $idcate)
         ->orderby('id_product','DESC')->take(24)->get();         
         }

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
                                                <div class="product-m__quick-look">

                                                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
                                               <div class="product-m__add-cart">
                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
                                                 <a class="btn--e-brand view_detail_modal">View</a>
                                                </div>
                                           </div>
                                    <div class="product-m__content">
                                        <span class="product-o__name" style =" display: block; height: 42px;">
                                        <a class="name_prouctxx" href="'.url('/detail_products/'.$product->id_product).'">'.$product->name_product.' </a>
                                       </span> 
                                        <span class="product-o__price"> '; 

                                        if($product->type_product == 0){
                                              $output.='<p class="text_price">'.$product->price_product.'.000đ</small></p> ';

                                        }else if($product->type_product == 1){
                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</small></p>'; 

                                        }else if($product->type_product == 2){
                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                                              $output.='<p class="text_price">AdminController.php'.$min.'.000đ - '.$max.'.000đ</small></p>'; 
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

                        $output .='  
                                 <div class="abcd" style="display: flex;justify-content: center;margin-top: 15px;" >
                                 <input type="hidden" class="id_store" value="'.$id_store.'">
                                 <input type="hidden" class="idcate" value="'.$idcate.'">             
                                    <button type="button" class="btn btn-info btn-sm" data-id="'.$last_id.'" id="load_more_procate_store_button" >load more</button>
                                   </div>     
                                                            
                         ';

       }else{

            $output .= '';
       }


        echo $output;



 }




/////////////////////// load product home

  public function load_more_product_home(Request $request){
         $data = $request->all();
         if($data['id']>0){

        $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
        ->where('id_product','<',$data['id'])
         ->orderby('id_product','DESC')->take(24)->get(); 

         }else{

         $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
        ->orderby('id_product','DESC')->take(24)->get();         
         }

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
                                                <div class="product-m__quick-look">

                                                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
                                               <div class="product-m__add-cart">
                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
                                                 <a class="btn--e-brand view_detail_modal">View</a>
                                                </div>
                                           </div>
                                    <div class="product-m__content">
                                        <span class="product-o__name" style =" display: block; height: 42px;">
                                        <a class="name_prouctxx" href="'.url('/detail_products/'.$product->id_product).'">'.$product->name_product.' </a>
                                       </span> 
                                        <span class="product-o__price"> '; 

                                        if($product->type_product == 0){
                                              $output.='<p class="text_price">'.$product->price_product.'.000đ</small></p> ';

                                        }else if($product->type_product == 1){
                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</small></p>'; 

                                        }else if($product->type_product == 2){
                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</small></p>'; 
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

                        $output .='  
                                 <div style="display: flex;justify-content: center;margin-top: 15px;" >
                                    <button type="button" class="btn btn-info btn-sm" data-id="'.$last_id.'" id="load_more_button" >load more</button>
                                   </div>     
                                                            
                         ';

       }else{

            $output .= '';
       }

         // <a class="btn--e-brand" onclick="view_detail_modal(this.id);" id="'.$product->id_product.'">View</a>


        echo $output;

         
  }



  ////////////////// product category ///////////////////////
  
   public function category_product_pages($id_areas){

     $category = tb_business_areas::get();
     $id_areasxx = tb_business_areas::where('id_areas', $id_areas)->orderby('id_areas', 'DESC')->get();

    return view('user.shopping.category_product') 
    ->with('category', $category)
     ->with('id_areas', $id_areasxx);

   }

   

 public function load_more_product_category(Request $request){
        $data = $request->all();
         $id_areas = $request->id_areas;

         if($data['id']>0){
          $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
        ->where('id_areas', $id_areas)->where('id_product','<',$data['id'])
         ->orderby('id_product','DESC')->take(24)->get(); 

         }else{

        $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
        ->where('id_areas', $id_areas)->orderby('id_product','DESC')->take(24)->get();         
         }

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
                                                <div class="product-m__quick-look">

                                                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
                                               <div class="product-m__add-cart">
                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
                                                 <a class="btn--e-brand view_detail_modal">View</a>
                                                </div>
                                           </div>
                                    <div class="product-m__content">
                                        <span class="product-o__name" style =" display: block; height: 42px;">
                                        <a class="name_prouctxx" href="'.url('/detail_products/'.$product->id_product).'">'.$product->name_product.' </a>
                                       </span> 
                                        <span class="product-o__price"> '; 

                                        if($product->type_product == 0){
                                              $output.='<p class="text_price">'.$product->price_product.'.000đ</small></p> ';

                                        }else if($product->type_product == 1){
                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</small></p>'; 

                                        }else if($product->type_product == 2){
                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</small></p>'; 
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

                        $output .='  
                                 <div class="abcd" style="display: flex;justify-content: center;margin-top: 15px;" >
                                 <input type="hidden" class="id_areas" value="'.$id_areas.'">
                                    <button type="button" class="btn btn-info btn-sm" data-id="'.$last_id.'" id="load_more_button" >load more</button>
                                   </div>     
                                                            
                         ';

       }else{

            $output .= '';
       }


        echo $output;



 }




  public function load_product_of_start(Request $request){
        $data = $request->all();
         $so_rating = $request->so_rating;

         if($data['id']>0){
           $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
        ->where('id_product','<',$data['id'])
         ->orderby('id_product','DESC')->take(24)->get(); 

         }else{

          $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
        ->orderby('id_product','DESC')->take(24)->get();         
         }

       $output ='';
       if(!$all_product->isEmpty()){

                $countchek =0;
            foreach($all_product as $key => $product){
                   $last_id = $product->id_product;

                   $count_rv = tb_review_product::where('id_product', $last_id)->count();

                   $product_sao = tb_review_product::where('id_product', $product->id_product) ->where('rating_review','>', 0)
                    ->avg('rating_review');
           
                   if(round($product_sao) == $so_rating){
                    $countchek++;
         
                     $output .= '

                       <div class="col-lg-3 col-md-6 col-sm-6">
                                 <div class="product-m">
                                         <div class="product-m__thumb">
                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.url('/detail_products/'.$product->id_product).'">

                                             <img class="aspect__img" src="'.asset('/uploadproduct/'.$product->image_product).'
                                                 " alt=""></a>
                                                <div class="product-m__quick-look">

                                                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
                                               <div class="product-m__add-cart">
                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
                                                 <a class="btn--e-brand view_detail_modal">View</a>
                                                </div>
                                           </div>
                                    <div class="product-m__content">
                                        <span class="product-o__name" style =" display: block; height: 42px;">
                                        <a class="name_prouctxx" href="'.url('/detail_products/'.$product->id_product).'">'.$product->name_product.' </a>
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
                      }

                        $output .='<div class="abcd" style="display: flex;justify-content: center;margin-top: 15px;" >
                                   <input type="hidden" class="so_rating" value="'.$so_rating.'">
                                   <input type="hidden" class="checkcountxx" value="'.$countchek.'">
                                   <button type="button" class="btn btn-info btn-sm" data-id="'.$last_id.'" 
                                    id="load_more_of_start_button" >load more</button>
                                   </div>';

       }else{

            $output .= '';
       }


        echo $output;



 }











/////////////// details product ///////////////////

     public function load_qty_and_price_product_details(Request $request){
        
        $pro = tb_product_store::where('id_product', $request->id_product)->first();
        if ($pro->type_product == 0) {

        $output['price_product'] = ''.$pro->price_product.'.000đ';
        $output['qty_product'] = $pro->qty_product;

        }else if($pro->type_product == 1){
            if ($request->id_type_pro == 0) {

                        $min = tb_type_product::where('id_product', $request->id_product)->min('price_type_product');
                        $max = tb_type_product::where('id_product', $request->id_product)->max('price_type_product');
                        $sum = tb_type_product::where('id_product', $request->id_product)->sum('qty_type_product');
                        $output['price_product'] = ''.$min.'.000đ - '.$max.'.000đ';
                        $output['qty_product'] = $sum;

            }else{

                $typ = tb_type_product::select('price_type_product','qty_type_product')->where('id_product', $request->id_product)
                ->where('id_type_pro', $request->id_type_pro)->first();      
                $output['price_product'] = ''.$typ->price_type_product.'.000đ';
                $output['qty_product'] = $typ->qty_type_product;

            }

     

        }else if($pro->type_product == 2){

            if ($request->id_size_pro == 0) {

                    $min = tb_size_product::where('id_product', $request->id_product)->min('price_size_product');
                    $max = tb_size_product::where('id_product', $request->id_product)->max('price_size_product');
                    $sum = tb_size_product::where('id_product', $request->id_product)->sum('qty_size_product');
                    $output['price_product'] = ''.$min.'.000đ - '.$max.'.000đ';
                    $output['qty_product'] = $sum;
            }else{
                $size = tb_size_product::select('price_size_product','qty_size_product')->where('id_product', $request->id_product)
                ->where('id_type_pro', $request->id_type_pro)->where('id_size_pro', $request->id_size_pro)->first();
                $output['price_product'] = ''.$size->price_size_product.'.000đ';
                $output['qty_product'] = $size->qty_size_product;
            }

 

        }


    
        echo json_encode($output);
             
      }



    public function load_type_pro_detals(Request $request){

          $proxx = tb_product_store::select('title_type')->where('id_product', $request->id_product)->first();

          $type_pro = tb_type_product::where('id_product', $request->id_product)->get();
            $count_rv =  $type_pro->count();
            $output=  '';
            if($count_rv > 0){ 
                 $output.=  '<h4><span class ="title_typexx">'.$proxx->title_type.'</span>:</h4>
                             <div class="payment-type cf" >';
                     foreach($type_pro as $key => $typ){
                      $output.= '
                           <input type="radio" name="radio1" id="'.$typ->id_type_pro.'" value="'.$typ->id_type_pro.'">
                           <label class="credit-label four col radio_type" for="'.$typ->id_type_pro.'"> 


                           '.$typ->name_type_pro.'</label>
                        ';
                       }
               

                 $output.=  '</div>';
            
           }
           else{

           $output.=  '';
          

           }
        echo $output;
      }

       public function load_size_pro_detals(Request $request){
          $id_product =$request->id_product;
         
           if($request->id_type_pro == 0){

           $size_pro =tb_size_product::select('name_size')->where('id_product', $request->id_product)->get()->unique('name_size');
        

           }else{
            $size_pro =tb_size_product::where('id_product', $request->id_product)
             ->where('id_type_pro', $request->id_type_pro)->get();
           }


            $count_rv =  $size_pro->count();
            $output=  '';
            if($count_rv > 0){ 
                      $output.= '<h4>Size:</h4>
                             <div class="payment-type cf" >';
                       foreach($size_pro as $key => $size){
                      $output.= '
                           <input type="radio" name="radio2" id="'.$size->name_size.'" value="'.$size->id_size_pro.'">
                           <label class="debit-label four col radio_size" for="'.$size->name_size.'">'.$size->name_size.'</label>
                        ';
                       }
               

                 $output.=  '</div>';
         
           }
           else{

           $output.=  '';

           }
         echo $output;
             
      }











  

 public function post_review_product(Request $request){
    $id_user = Auth::user()->id;
         
        if($id_user == null){
          $output['id_usersxx'] = "null";
            echo json_encode($output); 
        }else{

            $idusser = Auth::user()->id;  

             $review = new tb_review_product();
             $review->id_user =$idusser;

             $review->id_product =$request->id_product;
             $review->content_review =$request->content_review;
             $review->rating_review =$request->rating;

             $mytime = Carbon::now('Asia/Ho_Chi_Minh');
             $review->time_review =$mytime;
             $review->image_review = null;

               
              $review->save();
            $output['id_usersxx'] = "exist";
            echo json_encode($output); 
                
           

        }
            
         
  }
     public function load_sao_review_product(Request $request){
          $id_product =$request->id_product;
          $rview = tb_review_product::select('id_review','rating_review')
          ->where('id_product', $id_product)->get();
            $count_rv =  $rview->count();
            if($count_rv > 0){
               $total_rv =0;
               $Count_rv_sao = 0;
               foreach($rview as $key => $rview){
                    if($rview->rating_review > 0){
                          $Count_rv_sao++;
                          $total_rv = $total_rv + $rview->rating_review;

                     }

               }
               $abcd =0;
                if($Count_rv_sao>0){
                  $abcd = round($total_rv/$Count_rv_sao, 1);   
                }
                

                 $output=  '';
                     for ($i = 1; $i <= $abcd; $i++){   
                      $output.= '
                       <i class="fas fa-star"></i> 
                        ';
                       }
                      if($rview->rating_review < round($rview->rating_review)){
                         $output.=  ' 
                         <i class="fas fa-star-half-alt"></i> 
                       ';
                       } 

                
           }
           else{

           $output=  '';
         
           }
          echo $output;
             
      }
   public function load_qty_review_product(Request $request){
         $id_product =$request->id_product;
  
          $rview = tb_review_product::select('id_review','rating_review')
          ->where('id_product', $id_product)->get();
          $count_rv =  $rview->count();
          if($count_rv > 0){

               //  $rview_khong = tb_review_product::where('id_product', $id_product)->whereNotIn('rating_review',['0'])->get();
               // $count_rvxx =  $rview_khong->count();
               $total_rv =0;
               $Count_rv_sao = 0;
             foreach($rview as $key => $rview){
                if($rview->rating_review > 0){
                      $Count_rv_sao++;
                      $total_rv = $total_rv + $rview->rating_review;

                }

             }
             
            $nam_sao = tb_review_product::select('id_review')
               ->where('id_product', $id_product)->where(function ( $quesry) {
               $quesry->where('rating_review', 5)
                     ->orWhere('rating_review', 4.5);
              })->get();
      

            $bon_sao = tb_review_product::select('id_review',)
              ->where('id_product', $id_product)->where(function ( $query) {
               $query->where('rating_review', 4)
                     ->orWhere('rating_review', 3.5);
              })->get();
    

            $ba_sao = tb_review_product::select('id_review')
               ->where('id_product', $id_product)->where(function ( $query) {
               $query->where('rating_review', 3)
                     ->orWhere('rating_review', 2.5);
              })->get();

            $hai_sao = tb_review_product::select('id_review')
            ->where('id_product', $id_product)
            ->where(function ( $query) {
               $query->where('rating_review', 2)
                     ->orWhere('rating_review', 1.5);
              })->get();

            $mot_sao = tb_review_product::select('id_review')
               ->where('id_product', $id_product)->where('rating_review',1);
               
           $abcd =0;
            if($Count_rv_sao>0){
                  $abcd = round($total_rv/$Count_rv_sao, 1);   
            }
           

            $output['avg_rv'] =  $abcd;
            $output['qty_rv'] = $count_rv;
            $output['nam_sao'] = $nam_sao->count();
            $output['bon_sao'] = $bon_sao->count();
            $output['ba_sao'] =  $ba_sao->count();
            $output['hai_sao'] = $hai_sao->count();
            $output['mot_sao'] = $mot_sao->count();

             // dd($ba_sao->count());
    

          echo json_encode($output); 
          }else{


            $output['avg_rv'] = 0;
            $output['qty_rv'] = 0;
            $output['nam_sao'] = 0;
            $output['bon_sao'] = 0;
            $output['ba_sao'] = 0;
            $output['hai_sao'] = 0;
            $output['mot_sao'] = 0;
            $output['load_sao'] = '';
          
           echo json_encode($output);    
          }
 
         
  }

   public function load_more_review(Request $request){
         $data = $request->all();
         $id_product =$request->id_product;


  
         if($data['id']>0){

         $all_review = tb_review_product::where('id_product', $id_product)->where('id_review','<',$data['id'])
         ->join('users','users.id','=','tb_review_product.id_user')
         ->orderby('id_review','DESC')->take(2)->get(); 

         }else{

         $all_review = tb_review_product::where('id_product', $id_product)
         ->join('users','users.id','=','tb_review_product.id_user')
         ->orderby('id_review','DESC')->take(2)->get();         
         }

       $output ='';
       if(!$all_review->isEmpty()){

                foreach($all_review as $key => $rview){
                   $last_id = $rview->id_review;
                     $output .= '
                           <div class="review-o u-s-m-b-15">
                                   <div class="review-o__info u-s-m-b-8">

                                     <span class="review-o__name"> 
                                       ';
                                      if($rview->image_user != 0){
                                         $output.= ' 
                                         <img src="'.asset('/uploads/profile/'.$rview->id.'/'.$rview->image_user).'" alt="image" class="img-fluid avatar-xs rounded-circle">  
                                        ';
                                       }else{
                                        $output.= ' 
                                         <img src="'.asset('/uploads/profile/avt_user.png').'" alt="image" class="img-fluid avatar-xs rounded-circle">  
                                        ';
                                       }

                               $output .='

                                   


                                     &nbsp;  '.$rview->name.'</span>

                                                <span class="review-o__date">'.$rview->time_review.'</span>
                                        </div>
                                          <div class="review-o__rating gl-rating-style u-s-m-b-8">
                                           ';
                                                for ($i = 1; $i <= $rview->rating_review; $i++){   
                                                  $output.= ' 
                                                  <i class="fas fa-star"></i> 
                                                  ';
                                                }
                                                if($rview->rating_review < round($rview->rating_review)){
                                                    $output.= ' 
                                                  <i class="fas fa-star-half-alt"></i> 
                                                  ';
                                                }

                            $output .='
                              </div>
                                <p class="review-o__text">'.$rview->content_review.'</p>
                              </div>
                    
                               ';
                  }

                        $output .='  
                                 <div style="display: flex;justify-content: center;margin-top: 15px;" >
                                    <button type="button" class="btn btn-success btn-sm" data-id="'.$last_id.'" id="load_more_button" >load more</button>
                                   </div>     
                                                            
                         ';

       }else{

            $output .= '';
       }


        echo $output;

         
  }


   public function load_review_of_start(Request $request){
         $data = $request->all();
         $id_product =$request->id_product;
         $saoxx =$request->sao;


         $all_review = tb_review_product::where('id_product', $id_product)
             ->where(function ($query) use ($saoxx) {
              $query->where('rating_review', $saoxx)
                    ->orwhere('rating_review', $saoxx-0.5);

        })->join('users','users.id','=','tb_review_product.id_user')
         ->orderby('id_review','DESC')->get(); 

       // dd($all_review);
       $output ='';
       $count_as = $all_review->count();
       // dd($id_product);
       if($count_as){
                foreach($all_review as $key => $rview){
                  
                     $output .= '
                           <div class="review-o u-s-m-b-15">
                                   <div class="review-o__info u-s-m-b-8">

                                     <span class="review-o__name"> 
                                    ';
                                      if($rview->image_user != 0){
                                         $output.= ' 
                                         <img src="'.asset('/uploads/profile/'.$rview->id.'/'.$rview->image_user).'" alt="image" class="img-fluid avatar-xs rounded-circle">  
                                        ';
                                       }else{
                                        $output.= ' 
                                         <img src="'.asset('/uploads/profile/avt_user.png').'" alt="image" class="img-fluid avatar-xs rounded-circle">  
                                        ';
                                       }

                                $output .='

                                     &nbsp;  '.$rview->name.'</span>

                                                <span class="review-o__date">'.$rview->time_review.'</span>
                                        </div>
                                          <div class="review-o__rating gl-rating-style u-s-m-b-8">
                                           ';
                                                for ($i = 1; $i <= $rview->rating_review; $i++){   
                                                  $output.= ' 
                                                  <i class="fas fa-star"></i> 
                                                  ';
                                                }
                                                if($rview->rating_review < round($rview->rating_review)){
                                                    $output.= ' 
                                                  <i class="fas fa-star-half-alt"></i> 
                                                  ';
                                                }

                            $output .='
                              </div>
                                <p class="review-o__text">'.$rview->content_review.'</p>
                              </div>
                    
                               ';
                  }

   

       }else{

            $output .= '';
       }


        echo $output;

         
  }



/////////////////////////////////////////////////////


  public function CreateShop(Request $request){
         $data = array();
         $idusser = Auth::user()->id;     

         $data = $request->all();
         $store = new tb_store();
         $store->id_user = $idusser;
         $store->name_store = $data['name_store_rq'];
         $store->address_store = $data['address_store_rq'];
         $store->cmnd_user = $data['cmnd_store_rq'];
         $store->phone_store = $data['phone_store_rq'];
         $store->desc_store = $data['desc_store_rq'];
         $store->Category_store = $data['Category_store'];
         $store->type_store = 0;



          $datas['type_user'] = 2;
          DB::table('users')->where('id',$idusser)->update($datas);
          Session::put('type_user', 2);

         $get_image = $request->file('file');
           if($get_image == null){
            $store->avt_store = 'store.jpg';
            $store->save();
           }
           else {

                  $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
                  // $name_image = current(explode('.',$get_name_image));
                  // $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                  //  $get_image->move('public/uploads/store/',$new_image);
                 $path = public_path('uploads/store/'.$get_name_image);
                  Image::make($get_image->getRealPath())->fit(150, 150)->save($path);
                  $store->avt_store = $get_name_image;
         
                  $store->save();
              
           }

    }



























 //       public function load_product_of_price(Request $request){
 //        $data = $request->all();
 //         $so_rating = $request->so_rating;

 //        $all_product = tb_product_store::select('id_product','type_product')
 //        ->orderby('id_product','DESC')->take(24)->get();   


 //       $output ='';
 //       if(!$all_product->isEmpty()){

 //                $countchek =0;
 //            foreach($all_product as $key => $pro){

 //                    if($pro->type_product ==0){
 //                        $product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
 //                        ->where('id_product', $pro->id_product)->where('price_product','>', $request->price_to)->get();  

 //                         foreach($product as $key => $product){

 //                                     $count_rv = tb_review_product::where('id_product', $product->id_product)->count();

 //                                                   $product_sao = tb_review_product::where('id_product', $product->id_product) ->where('rating_review','>', 0)
 //                                                    ->avg('rating_review');
                                           
 //                                                   if(round($product_sao) == $so_rating){
 //                                                    $countchek++;
                                         
 //                                                     $output .= '

 //                                                       <div class="col-lg-3 col-md-6 col-sm-6">
 //                                                                 <div class="product-m">
 //                                                                         <div class="product-m__thumb">
 //                                                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.url('/detail_products/'.$product->id_product).'">

 //                                                                             <img class="aspect__img" src="'.asset('/uploadproduct/'.$product->image_product).'
 //                                                                                 " alt=""></a>
 //                                                                                <div class="product-m__quick-look">

 //                                                                                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
 //                                                                               <div class="product-m__add-cart">
 //                                                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
 //                                                                                 <a class="btn--e-brand view_detail_modal">View</a>
 //                                                                                </div>
 //                                                                           </div>
 //                                                                    <div class="product-m__content">
 //                                                                        <span class="product-o__name" style =" display: block; height: 42px;">
 //                                                                        <a class="name_prouctxx" href="'.url('/detail_products/'.$product->id_product).'">'.$product->name_product.' </a>
 //                                                                       </span> 
 //                                                                        <span class="product-o__price"> '; 

 //                                                                        if($product->type_product == 0){
 //                                                                              $output.='<p class="text_price">'.$product->price_product.'.000đ</p> ';

 //                                                                        }else if($product->type_product == 1){
 //                                                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
 //                                                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                                                     
 //                                                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 

 //                                                                        }else if($product->type_product == 2){
 //                                                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
 //                                                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

 //                                                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 
 //                                                                        }
                                                         
 //                                                                 $output.=' 
                                                                      
                                                                       
 //                                                                        </span>
 //                                                                        <br>

 //                                                                            <div class="product-m__rating gl-rating-style">
 //                                                                            ';

 //                                                                             for ($i = 1; $i <= $product_sao; $i++){   
 //                                                                                  $output.= ' 
 //                                                                                  <i class="fas fa-star"></i> 
 //                                                                                  ';
 //                                                                                }
 //                                                                                if($product_sao < round($product_sao)){
 //                                                                                    $output.= ' 
 //                                                                                  <i class="fas fa-star-half-alt"></i> 
 //                                                                                  ';
 //                                                                              }

 //                                                                  $output .='<span class="product-m__review">('.$count_rv.')</span>
 //                                                                             <span class="product-o__discount">  </div>

 //                                                                   </div>

 //                                                               </div>
 //                                                          </div>

 //                                                      ';
 //                                                          }



 //                        }


 //                    }else if($pro->type_product ==1){

 //                               $tb_type_product = tb_type_product::where('id_product', $pro->id_product)->where('price_type_product', '>', $request->price_to)
 //                                         ->get();  
 //                                        foreach($tb_type_product as $key => $proxx){
 //                                             $product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
 //                                              ->where('id_product', $proxx->id_product)->first(); 

                                                
 //                                               $count_rv = tb_review_product::where('id_product', $product->id_product)->count();

 //                                                   $product_sao = tb_review_product::where('id_product', $product->id_product) ->where('rating_review','>', 0)
 //                                                    ->avg('rating_review');
                                           
 //                                                   if(round($product_sao) == $so_rating){
 //                                                    $countchek++;
                                         
 //                                                     $output .= '

 //                                                       <div class="col-lg-3 col-md-6 col-sm-6">
 //                                                                 <div class="product-m">
 //                                                                         <div class="product-m__thumb">
 //                                                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.url('/detail_products/'.$product->id_product).'">

 //                                                                             <img class="aspect__img" src="'.asset('/uploadproduct/'.$product->image_product).'
 //                                                                                 " alt=""></a>
 //                                                                                <div class="product-m__quick-look">

 //                                                                                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
 //                                                                               <div class="product-m__add-cart">
 //                                                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
 //                                                                                 <a class="btn--e-brand view_detail_modal">View</a>
 //                                                                                </div>
 //                                                                           </div>
 //                                                                    <div class="product-m__content">
 //                                                                        <span class="product-o__name" style =" display: block; height: 42px;">
 //                                                                        <a class="name_prouctxx" href="'.url('/detail_products/'.$product->id_product).'">'.$product->name_product.' </a>
 //                                                                       </span> 
 //                                                                        <span class="product-o__price"> '; 

 //                                                                        if($product->type_product == 0){
 //                                                                              $output.='<p class="text_price">'.$product->price_product.'.000đ</p> ';

 //                                                                        }else if($product->type_product == 1){
 //                                                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
 //                                                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                                                     
 //                                                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 

 //                                                                        }else if($product->type_product == 2){
 //                                                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
 //                                                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

 //                                                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 
 //                                                                        }
                                                         
 //                                                                 $output.=' 
                                                                      
                                                                       
 //                                                                        </span>
 //                                                                        <br>

 //                                                                            <div class="product-m__rating gl-rating-style">
 //                                                                            ';

 //                                                                             for ($i = 1; $i <= $product_sao; $i++){   
 //                                                                                  $output.= ' 
 //                                                                                  <i class="fas fa-star"></i> 
 //                                                                                  ';
 //                                                                                }
 //                                                                                if($product_sao < round($product_sao)){
 //                                                                                    $output.= ' 
 //                                                                                  <i class="fas fa-star-half-alt"></i> 
 //                                                                                  ';
 //                                                                              }

 //                                                                  $output .='<span class="product-m__review">('.$count_rv.')</span>
 //                                                                             <span class="product-o__discount">  </div>

 //                                                                   </div>

 //                                                               </div>
 //                                                          </div>

 //                                                      ';
 //                                                          }
                                                          
                                         



 //                        }


 //                    }else if($pro->type_product ==2){
                    

 //                                         $tb_size_product = tb_size_product::where('id_product', $pro->id_product)->where('price_size_product', '>', $request->price_to)
 //                                         ->get();  
 //                                          foreach($tb_size_product as $key => $pross){
 //                                                $product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
 //                                                ->where('id_product', $pross->id_product)->first(); 

                                                
 //                                               $count_rv = tb_review_product::where('id_product', $product->id_product)->count();

 //                                                   $product_sao = tb_review_product::where('id_product', $product->id_product) ->where('rating_review','>', 0)
 //                                                    ->avg('rating_review');
                                           
 //                                                   if(round($product_sao) == $so_rating){
 //                                                    $countchek++;
                                         
 //                                                     $output .= '

 //                                                       <div class="col-lg-3 col-md-6 col-sm-6">
 //                                                                 <div class="product-m">
 //                                                                         <div class="product-m__thumb">
 //                                                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.url('/detail_products/'.$product->id_product).'">

 //                                                                             <img class="aspect__img" src="'.asset('/uploadproduct/'.$product->image_product).'
 //                                                                                 " alt=""></a>
 //                                                                                <div class="product-m__quick-look">

 //                                                                                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
 //                                                                               <div class="product-m__add-cart">
 //                                                                                  <input class="id_productss" type="hidden" value="'.$product->id_product.'" >
 //                                                                                 <a class="btn--e-brand view_detail_modal">View</a>
 //                                                                                </div>
 //                                                                           </div>
 //                                                                    <div class="product-m__content">
 //                                                                        <span class="product-o__name" style =" display: block; height: 42px;">
 //                                                                        <a class="name_prouctxx" href="'.url('/detail_products/'.$product->id_product).'">'.$product->name_product.' </a>
 //                                                                       </span> 
 //                                                                        <span class="product-o__price"> '; 

 //                                                                        if($product->type_product == 0){
 //                                                                              $output.='<p class="text_price">'.$product->price_product.'.000đ</p> ';

 //                                                                        }else if($product->type_product == 1){
 //                                                                              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
 //                                                                              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                                                     
 //                                                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 

 //                                                                        }else if($product->type_product == 2){
 //                                                                              $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
 //                                                                              $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

 //                                                                              $output.='<p class="text_price">'.$min.'.000đ - '.$max.'.000đ</p>'; 
 //                                                                        }
                                                         
 //                                                                 $output.=' 
                                                                      
                                                                       
 //                                                                        </span>
 //                                                                        <br>

 //                                                                            <div class="product-m__rating gl-rating-style">
 //                                                                            ';

 //                                                                             for ($i = 1; $i <= $product_sao; $i++){   
 //                                                                                  $output.= ' 
 //                                                                                  <i class="fas fa-star"></i> 
 //                                                                                  ';
 //                                                                                }
 //                                                                                if($product_sao < round($product_sao)){
 //                                                                                    $output.= ' 
 //                                                                                  <i class="fas fa-star-half-alt"></i> 
 //                                                                                  ';
 //                                                                              }

 //                                                                  $output .='<span class="product-m__review">('.$count_rv.')</span>
 //                                                                             <span class="product-o__discount">  </div>

 //                                                                   </div>

 //                                                               </div>
 //                                                          </div>

 //                                                      ';
 //                                                          }
                                                        
                                        



 //                         }
    
                        
 //                    }




 //           }

       

 //       }else{

 //            $output .= '';
 //       }


 //        echo $output;



 // }

       

}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
use App\tb_detail_order;
use App\tb_active_user;
use DB;
use Carbon\Carbon;

class ApiShoppingController extends Controller
{
public function LoadCategory(){
     $Modelcate = tb_business_areas::select('id_areas', 'name_areas', 'image_areas')->orderby('id_areas', 'DESC')->get();  
         $data = ['ModelCateProduct'=>$Modelcate];

         return response()->json($data, 200);

   }

public function LoadProduct_Sale(){

   // $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
   //     ->orderby('id_product','DESC')->get(); 

      $active = tb_active_user::where('type_active', "Search_Product")
             ->select('tb_active_user.id_product')
             ->groupBy('tb_active_user.id_product')
             ->orderby('id','DESC')->get();
 
        $arr = [];
        foreach($active as $key => $prod){

        $product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
            ->where('id_product', $prod->id_product)->first(); 

         $qtysale = tb_detail_order::select('id_details_order', 'id_product')->where('id_product', $prod->id_product)->get()->count(); 

         if($product->type_product == 0){
            $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $product->price_product,
               'qty_sale'=> $qtysale

            ];

         }else if($product->type_product == 1){
              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
            $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $min,
               'price_pro2' => $max,
               'qty_sale'=> $qtysale
            ];

         }else if($product->type_product == 2){
             $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
             $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

             $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $min,
               'price_pro2' => $max,
               'qty_sale'=> $qtysale
               ];
            


        }
     }
 
     $data = ['ModelProduct'=>$arr];
     return response()->json($data, 200);
 
   }

public function LoadProduct_All(){
      $all_product = tb_product_store::select('id_product','type_product','name_product','image_product', 'price_product')
       ->orderby('id_product','DESC')->get(); 
 
        $arr = [];
        foreach($all_product as $key => $product){

         $qtysale = tb_detail_order::select('id_details_order', 'id_product')->where('id_product', $product->id_product)->get()->count(); 

         if($product->type_product == 0){
            $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $product->price_product,
               'qty_sale'=> $qtysale

            ];

         }else if($product->type_product == 1){
              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
            $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $min,
               'price_pro2' => $max,
               'qty_sale'=> $qtysale
            ];

         }else if($product->type_product == 2){
             $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
             $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

             $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $min,
               'price_pro2' => $max,
               'qty_sale'=> $qtysale
               ];
            


        }
     }

     usort($arr, function($a, $b) {
        return $b['qty_sale'] - $a['qty_sale'];
     });

 
     $data = ['ModelProduct'=>$arr];
     return response()->json($data, 200);
 
   }



public function LoadDetailProduct(Request $request){
         $all_product = tb_product_store::select('id_product','type_product','name_product','image_product','title_type', 'price_product','qty_product','desc_product','details_product')
       ->where('id_product',$request->id_product)->get(); 
 
        $arr = [];
        foreach($all_product as $key => $product){
         $qtysale = tb_detail_order::select('id_details_order', 'id_product')->where('id_product', $request->id_product)->get()->count(); 

         if($product->type_product == 0){
            $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $product->price_product,
               'qty_sale'=> $qtysale,
               'qty_product'=>$product->qty_product,
               'details_product'=> $product->details_product,
               'desc_product'=> $product->desc_product

            ];

         }else if($product->type_product == 1){
              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
              $qty_product = tb_type_product::where('id_product', $product->id_product)->sum('qty_type_product');
                                     
            $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'title_type'=> $product->title_type,     
               'price_product'=> $min,
               'price_pro2' => $max,
               'qty_sale'=> $qtysale,
               'qty_product'=> $qty_product,
               'details_product'=> $product->details_product,
               'desc_product'=> $product->desc_product

            ];

         }else if($product->type_product == 2){
             $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
             $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');
             $qty_product = tb_size_product::where('id_product', $product->id_product)->sum('qty_size_product');

             $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'title_type'=> $product->title_type,     
               'price_product'=> $min,
               'price_pro2' => $max,
               'qty_sale'=> $qtysale,
               'qty_product'=> $qty_product,
               'details_product'=> $product->details_product,
               'desc_product'=> $product->desc_product
               ];
            

        }
     }
 
     $data = ['ModelProduct'=>$arr];
     return response()->json($data, 200);
 
   }


public function LoadIforStore(Request $request){

      $id_store = tb_product_store::select('id_product', 'id_store')->where('id_product', $request->id_product)->first();  
      $store = tb_store::where('id_store', $id_store->id_store)->get();  

         $data = ['Model_Store'=>$store];

         return response()->json($data, 200);

 
   }

public function LoadTypeProduct(Request $request){
        $type_pro = tb_type_product::where('id_product', $request->id_product)->get();
        $data = ['ModelType_Pro'=>$type_pro];

         return response()->json($data, 200);

 
   }

public function LoadSizeProduct(Request $request){

           if($request->id_type == 0){

           $size_pro =tb_size_product::select('name_size')->where('id_product', $request->id_product)->get()->unique('name_size');
        
           $data = ['ModelSize_Pro'=>$size_pro];
            return response()->json($data, 200);

           }else{
            $size_pro =tb_size_product::where('id_product', $request->id_product)
             ->where('id_type_pro', $request->id_type)->get();

            $data = ['ModelSize_Pro'=>$size_pro];
            return response()->json($data, 200);

           }
 
   }

public function getDetails_Affter_choose(Request $request){

           if($request->id_size == 0){

           $type_product = tb_type_product::where('id_type_pro', $request->id_type)->get();

              foreach($type_product as $key => $vi){
                  $arr[] = [             
                     'pice_pro' => $vi->price_type_product,
                     'qty_kho'=> $vi->qty_type_product
                     ];
             }

            $data = ['Model_Load_PriceChoose'=>$arr];
            return response()->json($data, 200);

           }else{

             $size_pro = tb_size_product::where('id_size_pro', $request->id_size)->get();

              foreach($size_pro as $key => $vi){
                  $arr[] = [             
                     'pice_pro' => $vi->price_size_product,
                     'qty_kho'=> $vi->qty_size_product
                     ];
             }


            $data = ['Model_Load_PriceChoose'=>$arr];
            return response()->json($data, 200);

           }
 
   }

   public function LoadRview_Product(Request $request){

         $id_product =$request->id_product;
         $qtyrv =$request->qtyrv;
         if($qtyrv == 1){
          $all_review = tb_review_product::select('tb_review_product.*', 'users.name', 'users.image_user')->where('id_product', $id_product)
         ->join('users','users.id','=','tb_review_product.id_user')
         ->orderby('id_review','DESC')->get(10); 

          $data = ['ModelReView_Pro'=>$all_review];
          return response()->json($data, 200);
 

         }else if($qtyrv == 0){
          $all_review = tb_review_product::select('tb_review_product.*', 'users.name', 'users.image_user')->where('id_product', $id_product)
         ->join('users','users.id','=','tb_review_product.id_user')
         ->orderby('id_review','DESC')->get(); 

          $data = ['ModelReView_Pro'=>$all_review];
          return response()->json($data, 200);

         }
      
   }



public function PostCommentProduct(Request $request){
        $idusser = $request->id_user; 

             $review = new tb_review_product();
             $review->id_user =$idusser;

             $review->id_product =$request->id_product;
             $review->content_review =$request->content;
             $review->rating_review =$request->sosao;

             $mytime = Carbon::now('Asia/Ho_Chi_Minh');
             $review->time_review =$mytime;
             $review->image_review = null;
             $review->save();

               $data = ['messages'=>"save success"];
              return response()->json($data, 200);
   }


   public function Load_Qty_Review(Request $request){


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

                      $arr[] = [
                                 'avg_rv' => $abcd,
                                 'qty_rv' => $count_rv,
                                 'nam_sao' => $nam_sao->count(),
                                 'bon_sao' => $bon_sao->count(),
                                 'ba_sao' => $ba_sao->count(),
                                 'hai_sao' =>$hai_sao->count(),    
                                 'mot_sao' => $mot_sao->count(), 
                                
                                 ]; 
    

               $data = ['Model_Qty_rv'=>$arr];
              return response()->json($data,200);

          }else{


                      $arr[] = [
                                 'avg_rv' => 0,
                                 'qty_rv' => 0,
                                 'nam_sao' =>0,
                                 'bon_sao' => 0,
                                 'ba_sao' => 0,
                                 'hai_sao' =>0,    
                                 'mot_sao' => 0, 
                                
                                 ]; 
    

               $data = ['Model_Qty_rv'=>$arr];
              return response()->json($data,200);
          }
         
   }



}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\New_Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\tb_store;
use Carbon\Carbon;
use Session;
use App\tb_user;
use App\tb_product_store;
use App\tb_business_areas;

use App\City;
use App\Wards;
use App\Province;

use App\tb_shipping;
use App\tb_type_product;
use App\tb_size_product;
use App\tb_cart;
use App\tb_order_of_user;
use App\tb_order_of_store;
use App\tb_detail_order;
use App\tb_shipping_order;


use DB;
use Illuminate\Support\Facades\Auth;

class ApiCheckout extends Controller
{


     public function GetInfo_Ship(Request $request){
          $id_user = $request->id_user;
          $info_ship = tb_shipping::select('id_shipping','type_shipping','name_shipping','address_shipping','desc_address', 'phone_shipping')
         ->where('id_user', $id_user)->where('check_shipping', 1)->get();


         $data = ['Model_Shipping'=>$info_ship];
         return response()->json($data, 200);

      }

      public function LoadItem_CheckOut(Request $request){
      $id_user = $request->id_user;

       $qtypros = tb_cart::where('id_user', $id_user)->where('check_item', '=', 1)
        ->join('tb_product_store','tb_cart.id_product','=','tb_product_store.id_product')
        ->select('tb_product_store.type_product', 'tb_product_store.name_product','tb_product_store.image_product','tb_product_store.price_product',
           'tb_cart.id_product','tb_cart.qty_product','tb_cart.id_cart','tb_cart.id_type_product','tb_cart.id_size_product','tb_cart.check_item')
        ->orderBy('id_cart', "DESC")->get();


      // $itecart = tb_cart::where('id_cart', $request->id_cart)->get();
      // $itemproduct = tb_product_store_::where('id_product', $itecart->id_product)->first();
   $count = $qtypros->count();
   if($count>0){
     foreach($qtypros as $key => $qtypro){        
                  if ($qtypro->type_product ==0) {
                   $qtymx = tb_product_store::where('id_product', $qtypro->id_product)->select('price_product','qty_product')->first();
                           $arr[] = [
                                 'id_cart' => $qtypro->id_cart,
                                 'id_product' => $qtypro->id_product,
                                 'type_product' => $qtypro->type_product,
                                 'id_type_product' => $qtypro->id_type_product,
                                 'id_size_product' => $qtypro->id_size_product,
                                 'qty_product' => $qtypro->qty_product,    
                                 'check_item' => $qtypro->check_item, 

                                 'Name_item' => $qtypro->name_product,
                                 'image_item' => $qtypro->image_product,

                                 'price_item' => $qtymx->price_product,
                                 'qty_kho_item' => $qtymx->qty_product,
                                 'type_item'=> ""

                                
                                 ];
                  }else if ($qtypro->type_product ==1) {
                       $type = tb_type_product::select('name_type_pro', 'price_type_product','qty_type_product')->where('id_type_pro', $qtypro->id_type_product)
                          ->first();
                           $arr[] = [
                                 'id_cart' => $qtypro->id_cart,
                                 'id_product' => $qtypro->id_product,
                                 'type_product' => $qtypro->type_product,
                                 'id_type_product' => $qtypro->id_type_product,
                                 'id_size_product' => $qtypro->id_size_product,
                                 'qty_product' => $qtypro->qty_product,    
                                 'check_item' => $qtypro->check_item, 

                                 'Name_item' => $qtypro->name_product,
                                 'image_item' => $qtypro->image_product,

                                 'price_item' => $type->price_type_product,
                                 'qty_kho_item' => $type->qty_type_product,
                                 'type_item'=> $type->name_type_pro

                                
                                 ];

               

                  }else if ($qtypro->type_product ==2) {
                           $size = tb_size_product::where('id_size_pro', $qtypro->id_size_product)
                          ->join('tb_type_product','tb_size_product.id_type_pro','=','tb_type_product.id_type_pro')
                          ->select('tb_size_product.name_size', 'tb_size_product.price_size_product', 'tb_type_product.name_type_pro','tb_size_product.qty_size_product')
                           ->first();

                           $arr[] = [
                                 'id_cart' => $qtypro->id_cart,
                                 'id_product' => $qtypro->id_product,
                                 'type_product' => $qtypro->type_product,
                                 'id_type_product' => $qtypro->id_type_product,
                                 'id_size_product' => $qtypro->id_size_product,
                                 'qty_product' => $qtypro->qty_product,    
                                 'check_item' => $qtypro->check_item, 

                                 'Name_item' => $qtypro->name_product,
                                 'image_item' => $qtypro->image_product,

                                 'price_item' => $size->price_size_product,
                                 'qty_kho_item' => $size->qty_size_product,
                                 'type_item'=> $size->name_type_pro.",".$size->name_size

                                
                                 ];          

                  }
          }

          $data = ['ModelCart'=>$arr];
          return response()->json($data,200);
       }else{

          $data = ['ModelCart'=>"No item"];
          return response()->json($data,404);
       }
         
   }


   /////////////////////save checkout cart/////////////////////
   public function comfirm_checkout_CartItem(Request $request){
        $id_user = $request->id_user;

         $order_code = "#".substr(md5(microtime()),rand(0,26),5); 
         $mytime = Carbon::now('Asia/Ho_Chi_Minh');

         $email_us = tb_user::where('id', $id_user)->first();

         ///////// user order //////////

          $order_of_user = new tb_order_of_user();
          $order_of_user->id_user = $id_user;
          $order_of_user->order_code = $order_code;
          $order_of_user->method_payment =$request->method_pay;
          
          $order_of_user->discount_order= $request->pt_dis;
          $order_of_user->total_order= $request->totalx;
          
          $order_of_user->time_order= $mytime;

          $order_of_user->save();
          $id_order_user = $order_of_user->id_order_user;

           ///////// store order //////////
          $pro_ck = tb_cart::select('id_store','id_cart','id_product','type_product','qty_product','id_type_product','id_size_product')
          ->where('id_user',$id_user)->where('check_item', 1)->get()->unique('id_store');
           
          // $items = array();
         foreach($pro_ck as $key => $pro_cks){ 

              $order_of_store = new tb_order_of_store();
              $order_of_store->id_store = $pro_cks->id_store;
              $order_of_store->id_order_user = $id_order_user;
              $order_of_store->order_code = $order_code;

              $to_item = tb_cart::select('id_store','id_cart','id_product','type_product','qty_product','id_type_product','id_size_product')
             ->where('id_user',$id_user)->where('id_store',$pro_cks->id_store)->where('check_item', 1)->get();

              $total_item = 0;    
                     foreach($to_item as $key => $to_item){
                       if($to_item->type_product == 0){
                         $prod = tb_product_store::select('price_product')->where('id_product', $to_item->id_product)
                         ->first();
                         $item = $to_item->qty_product * $prod->price_product;
                         $total_item += $item;

                        }else if($to_item->type_product == 1){

                         $type = tb_type_product::select('price_type_product')->where('id_type_pro', $to_item->id_type_product)
                                ->first();
                         $item = $to_item->qty_product * $type->price_type_product;
                         $total_item += $item;

                        }else if($to_item->type_product == 2){

                         $size = tb_size_product::where('id_size_pro', $to_item->id_size_product)
                         ->select('price_size_product')->first();
                          $item = $to_item->qty_product * $size->price_size_product;
                          $total_item += $item;
                        }
                      }
              $order_of_store->total_order = $total_item;
              $order_of_store->time_order = $mytime->toDateString();   
              $order_of_store->order_status = 0;
              $order_of_store->save();
          }

       /////////  shipng order detail //////////
          $shipx = tb_shipping::where('id_shipping', $request->id_ship_cf)->first();

          $shipping = new tb_shipping_order();
          $shipping->id_user = $id_user;
          $shipping->name_shipping = $shipx->name_shipping;
          $shipping->email_user = $email_us->email;
         
          $shipping->desc_address_ship = $shipx->desc_address;
          $shipping->address_ship = $shipx->address_shipping;
          $shipping->phone_order = $shipx->phone_shipping;
          $shipping->type_address = $shipx->type_shipping;
          $shipping->id_order_user = $id_order_user;
          $shipping->save();
    
        /////////  order detail //////////
          $qtypros = tb_cart::where('id_user', $id_user)->where('check_item', 1)
         ->select('id_cart','id_store','id_product','type_product','qty_product','id_type_product','id_size_product')->get();
 

          foreach($qtypros as $key => $qtypr){

                  $tb_detail_order = new tb_detail_order();
                  $tb_detail_order->id_product = $qtypr->id_product;
                  $tb_detail_order->type_pro = $qtypr->type_product;
                  $tb_detail_order->qty_product =$qtypr->qty_product;

                  if($qtypr->type_product == 0){
                   $prod = tb_product_store::select('price_product','qty_product')->where('id_product', $qtypr->id_product)->first();

                   $item = $qtypr->qty_product * $prod->price_product;
                   $tb_detail_order->price_product=$prod->price_product;
                   $tb_detail_order->price_items= $item;


                    //// update Quality/////
                    tb_product_store::where('id_product', $qtypr->id_product)
                    ->update(['qty_product' =>  $prod->qty_product - $qtypr->qty_product]);


                  }else if($qtypr->type_product == 1){
                   $type = tb_type_product::select('name_type_pro','price_type_product','qty_type_product')
                   ->where('id_type_pro', $qtypr->id_type_product)->first();
                   $tb_detail_order->name_type = $type->name_type_pro;


                   $item = $qtypr->qty_product * $type->price_type_product;
                   $tb_detail_order->price_product=$type->price_type_product;
                   $tb_detail_order->price_items= $item;

                     //// update Quality/////
                    tb_type_product::where('id_type_pro', $qtypr->id_type_product)
                    ->update(['qty_type_product' =>  $type->qty_type_product - $qtypr->qty_product]);

                  }else if($qtypr->type_product == 2){

                   $type = tb_type_product::select('name_type_pro')->where('id_type_pro', $qtypr->id_type_product)->first();
                   $size = tb_size_product::select('name_size','price_size_product','qty_size_product')
                   ->where('id_size_pro', $qtypr->id_size_product)->first();
                   $tb_detail_order->name_type = $type->name_type_pro;
                   $tb_detail_order->name_size = $size->name_size;


                    $item = $qtypr->qty_product * $size->price_size_product;
                    $tb_detail_order->price_product=$size->price_size_product;
                    $tb_detail_order->price_items= $item;



                    //// update Quality/////
                    tb_size_product::where('id_size_pro', $qtypr->id_size_product)
                    ->update(['qty_size_product' =>  $size->qty_size_product - $qtypr->qty_product]);

                   }
               
                 $tb_detail_order->order_code= $order_code;
                 $tb_detail_order->id_order_user= $id_order_user;
                 $tb_detail_order->id_store= $qtypr->id_store;
                 $tb_detail_order->save();
          }




         
           tb_cart::where('id_user',$id_user)->where('check_item', 1)->delete();

                 $data = [
                'name' => $email_us->name,
                'email' =>$email_us->email
                ];
               Mail::to($email_us->email)->send(new New_Order($data));
               
             $data = ['messages'=> "Success"];
          return response()->json($data,200);
        
} 

   /////////////////////save checkout Buy /////////////////////
   public function comfirm_checkout_BuyItem(Request $request){

         $id_user = $request->id_user;

         $order_code = "#".substr(md5(microtime()),rand(0,26),5); 
         $mytime = Carbon::now('Asia/Ho_Chi_Minh');

       $email_us = tb_user::where('id', $id_user)->first();
       $qtypr = tb_product_store::where('id_product', $request->id_product)->first();

         ///////// user order //////////

          $order_of_user = new tb_order_of_user();
          $order_of_user->id_user = $id_user;
          $order_of_user->order_code = $order_code;
          $order_of_user->method_payment =$request->method_pay;
          
          $order_of_user->discount_order= $request->pt_dis;
          $order_of_user->total_order= $request->totalx;
          
          $order_of_user->time_order= $mytime;

          $order_of_user->save();
          $id_order_user = $order_of_user->id_order_user;

           ///////// store order //////////
       
              $total_item = $request->Qty_item * $request->Price_item;
        

              $order_of_store = new tb_order_of_store();
              $order_of_store->id_store = $qtypr->id_store;
              $order_of_store->id_order_user = $id_order_user;
              $order_of_store->order_code = $order_code;
              $order_of_store->total_order = $total_item;
              $order_of_store->time_order = $mytime->toDateString();   
              $order_of_store->order_status = 0;
              $order_of_store->save();
     
       /////////  shipng order detail //////////
          $shipx = tb_shipping::where('id_shipping', $request->id_ship_cf)->first();



          $shipping = new tb_shipping_order();
          $shipping->id_user = $id_user;
          $shipping->name_shipping = $shipx->name_shipping;
          $shipping->email_user = $email_us->email;
          $shipping->desc_address_ship = $shipx->desc_address;
          $shipping->address_ship = $shipx->address_shipping;
          $shipping->phone_order = $shipx->phone_shipping;
          $shipping->type_address = $shipx->type_shipping;
          $shipping->id_order_user = $id_order_user;
          $shipping->save();
    
        /////////  order detail //////////
    

                  $tb_detail_order = new tb_detail_order();
                  $tb_detail_order->id_product = $qtypr->id_product;
                  $tb_detail_order->type_pro = $qtypr->type_product;
                  $tb_detail_order->qty_product =$request->Qty_item;

                  $tb_detail_order->price_product=$request->Price_item;
                  $tb_detail_order->price_items= $total_item;

                  $tb_detail_order->order_code= $order_code;
                  $tb_detail_order->id_order_user= $id_order_user;
                  $tb_detail_order->id_store= $qtypr->id_store;
              

                if($request->type_pro == 0){
                 
                    //// update Quality/////
                    tb_product_store::where('id_product', $request->id_product)
                    ->update(['qty_product' =>  $qtypr->qty_product - $request->Qty_item]);

                  }else if($request->type_pro == 1){
               
                    $type = tb_type_product::select('qty_type_product')
                   ->where('id_type_pro', $request->id_type)->first();
                     //// update Quality/////
                    tb_type_product::where('id_type_pro', $request->id_type)
                    ->update(['qty_type_product' =>  $type->qty_type_product - $request->Qty_item]);
                     $tb_detail_order->name_type = $request->name_type;
                  }else if($request->type_pro == 2){
                    //// update Quality/////
                   $tb_detail_order->name_type = $request->name_type;
                   $tb_detail_order->name_size = $request->name_size;
                      $size = tb_size_product::select('qty_size_product')
                   ->where('id_size_pro', $request->id_size)->first();

                    tb_size_product::where('id_size_pro', $request->id_size)
                    ->update(['qty_size_product' =>  $size->qty_size_product - $request->Qty_item]);

                   }

             $tb_detail_order->save();
            $data = [
                'name' => $email_us->name,
                'email' =>$email_us->email
                ];
               Mail::to($email_us->email)->send(new New_Order($data));
      
             $data = ['messages'=> "Success"];
          return response()->json($data,200);
        
   } 




   public function Get_My_Order(Request $request){
     $Model_My_Order = tb_order_of_user::where('id_user', $request->id_user)->orderby('id_order_user', "DESC")->get();  

      $data = ['Model_My_Order'=>$Model_My_Order];
      return response()->json($data, 200);
    }

   public function Get_My_Store_Order(Request $request){
     $Model_My_Order_Store = tb_order_of_store::where('id_order_user', $request->id_my_order)->get();  

      $data = ['Model_My_Order_Store'=>$Model_My_Order_Store];
      return response()->json($data, 200);
    }

   public function Get_My_Order_Product(Request $request){
     $Model_My_Order_Product = tb_detail_order::where('tb_detail_order.id_store', $request->id_store)->where('tb_detail_order.id_order_user', $request->id_order_user)
     ->join('tb_product_store', 'tb_detail_order.id_product', 'tb_product_store.id_product')
     ->select('tb_detail_order.*','tb_product_store.name_product', 'tb_product_store.image_product')->get(); 
      $data = ['Model_My_Order_Product'=>$Model_My_Order_Product];
      return response()->json($data, 200);
    }



 
   public function Load_Shipping(Request $request){
     $Model_Shipping = tb_shipping::where('id_user', $request->id_user)->get(); 

      $data = ['Model_Shipping'=>$Model_Shipping];
      return response()->json($data, 200);
    }
    public function Clear_Shipping(Request $request){

      tb_shipping::where('id_shipping', $request->id_ship)->delete();

      $data = ['messages'=>"Success"];
      return response()->json($data, 200);
    }
    public function Update_Check_Shipping(Request $request){

      tb_shipping::where('id_shipping', $request->id_ship)->update(['check_shipping' => $request->check]);

      $data = ['messages'=>"Success"];
      return response()->json($data, 200);
    }




}

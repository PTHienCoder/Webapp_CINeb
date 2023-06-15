<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\tb_store;
use Session;
use App\tb_user;
use App\tb_product_store;
use App\tb_business_areas;
use App\tb_type_product;
use App\tb_size_product;
use App\tb_cart;
use DB;

class ApiCart extends Controller
{

public function AddProductCart(Request $request){
        $id_product = $request->id_product;
        // $id_user = Auth::user()->id;
           $id_user = $request->id_user;
        $checktype = tb_product_store::select('id_product','id_store','type_product')
        ->where('id_product', $id_product)->first();
         
        if($checktype->type_product == 0){

          $check_cart = tb_cart::where('id_product', $id_product)->where('id_user', $id_user)->first();

            if($check_cart){

                $data = array();
                $data['qty_product'] =  $check_cart->qty_product + $request->qty_pro;
                tb_cart::where('id_cart', $check_cart->id_cart)->update($data);
                    
                }else{

                 $cart = new tb_cart();
                 $cart->id_user = $id_user;
                 $cart->id_store = $checktype->id_store;
                 $cart->id_product = $id_product;
                 $cart->type_product = $checktype->type_product;
                 $cart->qty_product = $request->qty_pro;
                 $cart->check_item = 0;
                 $cart->save();         
       
            }
         

           
        }else if($checktype->type_product == 1){

            $check_cart = tb_cart::where('id_product', $id_product)->where('id_user', $id_user)
            ->where('id_type_product', $request->id_type_product)->first();

            if($check_cart){

                $data = array();
                $data['qty_product'] =  $check_cart->qty_product + $request->qty_pro;
                tb_cart::where('id_cart', $check_cart->id_cart)->update($data);
                    
                }else{

                 $cart = new tb_cart();
                 $cart->id_user = $id_user;
                 $cart->id_store = $checktype->id_store;
                 $cart->id_product = $id_product;
                 $cart->type_product = $checktype->type_product;
                 $cart->id_type_product = $request->id_type_product;
                 $cart->qty_product = $request->qty_pro;
                 $cart->check_item = 0;
                 $cart->save();         
       
            }
         

      }else if($checktype->type_product == 2){

        $check_cart = tb_cart::where('id_product', $id_product)->where('id_user', $id_user)
            ->where('id_type_product', $request->id_type_product)->where('id_size_product', $request->id_size_product)->first();

            if($check_cart){

                $data = array();
                $data['qty_product'] =  $check_cart->qty_product + $request->qty_pro;
                tb_cart::where('id_cart', $check_cart->id_cart)->update($data);
                    
                }else{

                 $cart = new tb_cart();
                 $cart->id_user = $id_user;
                 $cart->id_store = $checktype->id_store;
                 $cart->id_product = $id_product;
                 $cart->type_product = $checktype->type_product;
                 $cart->id_type_product = $request->id_type_product;
                 $cart->id_size_product = $request->id_size_product;
                 $cart->qty_product = $request->qty_pro;
                 $cart->check_item = 0;
                 $cart->save();         
       
            }
          
      }
        $data = ['messages'=>"Success"];
        return response()->json($data, 200);
   }

public function Get_Qty_Cart(Request $request){
     // $id_user = Auth::user()->id;
   $id_user = $request->id_user;
      $qtypro = tb_cart::select('id_cart')->where('id_user', $id_user)->where('check_item', '<', 2)->get();
      $qty = $qtypro->count();
             $arr[] = [             
                     'qty_cart' => $qty,
                     ];
         
            $data = ['Model_Load_Qty_Cart'=>$arr];
            return response()->json($data, 200);
   }

public function LoadProductCart(Request $request){
      $id_user = $request->id_user;

       $qtypros = tb_cart::where('id_user', $id_user)->where('check_item', '<', 2)
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

 public function Update_checkItemCart(Request $request){
         $id_cart = $request->id_cart;
         $updatsse = $request->checkedd;
         $data = array(); 
         $data['check_item'] = $updatsse;
         tb_cart::where('id_cart', $id_cart)->update($data);

      $data = ['messages'=>"update success"];
      return response()->json($data, 200);
          
   }
public function Update_QtyItemCart(Request $request){
         $id_cart = $request->id_cart;
         $qty = $request->qty_item;

         $data = array(); 
         $data['qty_product'] = $qty;
         tb_cart::where('id_cart', $id_cart)->update($data);

     $data = ['messages'=>"update success"];
      return response()->json($data, 200);
          
  }

public function Clear_IteamCart(Request $request){
   $id_cart = $request->id_cart;
   $tb_cart = tb_cart::find($id_cart);  
   $tb_cart->delete();

    $data = ['delete'=>"update success"];
    return response()->json($data, 200);
}

public function LoadPriceCheckout(Request $request){
        $id_user = $request->id_user;
          $qtypros = tb_cart::select('id_cart','id_product','type_product','qty_product','id_type_product','id_size_product')
          ->where('id_user', $id_user)->where('check_item', 1)->get();
         
            
            $count = $qtypros->count();
            if($count>0){
                $total_cart = 0;
                foreach($qtypros as $key => $qtypr){

                  if($qtypr->type_product == 0){

                    // dd($qtypr->id_product);
                   $prod = tb_product_store::select('price_product')->where('id_product', $qtypr->id_product)
                   ->first();

                   $item = $qtypr->qty_product * $prod->price_product;
                   $total_cart += $item;

                  }else if($qtypr->type_product == 1){

                  $type = tb_type_product::select('price_type_product')->where('id_type_pro', $qtypr->id_type_product)
                          ->first();
                   $item = $qtypr->qty_product * $type->price_type_product;
                   $total_cart += $item;

                  }else if($qtypr->type_product == 2){

                   $size = tb_size_product::where('id_size_pro', $qtypr->id_size_product)
                   ->select('price_size_product')->first();
                    $item = $qtypr->qty_product * $size->price_size_product;
                   $total_cart += $item;

                  }

                }
               $arr[] = ['total' => $total_cart]; 
               $data = ['Model_TotalPriceCart'=>$arr];
               return response()->json($data, 200);
            }else{

               $arr[] = ['total' => 0]; 
               $data = ['Model_TotalPriceCart'=>$arr];
               return response()->json($data, 200);
            }
   }


}

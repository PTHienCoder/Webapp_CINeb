<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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


class CheckoutController extends Controller
{

  public function page_checkout(){
        $city = City::orderby('matp','ASC')->get();
        $id_user = Auth::user()->id;

        $checkship = tb_shipping::where('id_user', $id_user)->get();
        $count = $checkship->count();
        $ship = 0;
        if ($count>0) {
        $ship = 1;
        }

         return view('user.shopping.checkout_page')
         ->with('ship',$ship)
         ->with('city',$city);
  }
/////////////////////save checkout /////////////////////
   public function comfirm_checkout(Request $request){

         $id_user = Auth::user()->id;

         $order_code = "#".substr(md5(microtime()),rand(0,26),5); 
         $mytime = Carbon::now('Asia/Ho_Chi_Minh');



         ///////// user order //////////

          $order_of_user = new tb_order_of_user();
          $order_of_user->id_user = $id_user;
          $order_of_user->order_code = $order_code;
          $order_of_user->method_payment =$request->type_paymentxx;
          
          $order_of_user->discount_order= $request->pt_discx;
          $order_of_user->total_order= $request->total_order;
          
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
          $shipx = tb_shipping::where('id_shipping', $request->id_shipping_cf)->first();

          $shipping = new tb_shipping_order();
          $shipping->id_user = $id_user;
          $shipping->name_shipping = $shipx->name_shipping;
          $shipping->email_user = Auth::user()->email;
          
         
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
                'name' => Auth::user()->name,
                'email' =>Auth::user()->email
                ];
               Mail::to(Auth::user()->email)->send(new New_Order($data));
        
} 

        


     public function page_checkout_success(){
         return view('user.shopping.page_succeed');
    }
    






//////////////load check cout /////////////////////////


  public function load_pro_checkout_page(){

      $id_user = Auth::user()->id;
      $qtypros = tb_cart::where('id_user', $id_user)->where('check_item', 1)
        ->join('tb_product_store','tb_cart.id_product','=','tb_product_store.id_product')
        ->select('tb_product_store.id_product','tb_product_store.type_product', 'tb_product_store.name_product','tb_product_store.image_product','tb_product_store.price_product','tb_cart.qty_product','tb_cart.id_type_product','tb_cart.id_size_product')
        ->orderBy('id_cart', "DESC")->get();

            $output = ''; 
            $count = $qtypros->count();
            if($count>0){
              foreach($qtypros as $key => $qtypro){ 
              
                $output .= ' 
                      <tr class = "click_itemcart_layout">
                       <input type="hidden" min="1" value="'.$qtypro->id_product.'" class="id_proxx">       
                         <td>
                         <img src="'.asset('/uploadproduct/'.$qtypro->image_product).'"class="img-fluid avatar-md rounded-circle">
                         <p class="m-0 d-inline-block align-middle">
                         <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body fw-semibold">'.$qtypro->name_product.'</a>
                          <br>   ';

                  if($qtypro->type_product == 0){
                    $total = $qtypro->qty_product * $qtypro->price_product;
                     $output .= '<span>'.$qtypro->qty_product.' x '.$qtypro->price_product.'.000đ</span>
                         </p>
                         </td>
                         <td class="text-end">
                         '.$total.'.000đ
                         </td>


                      </tr>          
                    ';

                  }else if($qtypro->type_product == 1){
                      $type = tb_type_product::select('name_type_pro', 'price_type_product')->where('id_type_pro', $qtypro->id_type_product)
                      ->first();
                     $total = $qtypro->qty_product * $type->price_type_product;
                     $output .= '   
                        <span>'.$qtypro->qty_product.' x '.$type->price_type_product.'.000đ</span><br>
                        <span class="badge badge-outline-warning">'.$type->name_type_pro.'</span>
                         </p>
                         </td>
                         <td class="text-end">
                         '.$total.'.000đ
                         </td>


                      </tr>          
                    ';

                  }else if($qtypro->type_product == 2){
                      $size = tb_size_product::where('id_size_pro', $qtypro->id_size_product)
                      ->join('tb_type_product','tb_size_product.id_type_pro','=','tb_type_product.id_type_pro')
                      ->select('tb_size_product.name_size', 'tb_size_product.price_size_product', 'tb_type_product.name_type_pro')
                      ->first();
                     $total = $qtypro->qty_product * $size->price_size_product;
                     $output .= '   
                        <span>'.$qtypro->qty_product.' x '.$size->price_size_product.'.000đ</span><br>
                        <span class="badge badge-outline-warning">'.$size->name_type_pro.' , '.$size->name_size.'</span>
                         </p>
                         </td>
                         <td class="text-end">
                         '.$total.'.000đ
                         </td>


                      </tr>          
                    ';
                  }
                

               }
       

            }else{
              $output.='
                  <tr>
                      <td colspan="4">There are no products in the cart.</td>
                                               
                   </tr>
                   ';

            }
       
      
        echo $output;

    }



      public function load_info_delivery_checkout(){
         $id_user = Auth::user()->id;
          $info_ship = tb_shipping::select('id_shipping','type_shipping','name_shipping','address_shipping','desc_address', 'phone_shipping')
         ->where('id_user', $id_user)->where('check_shipping', 1)->get();

            $output = ''; 
            $count = $info_ship->count();
            if($count>0){
              foreach($info_ship as $key => $info_ship){ 
            
                $output .= ' 
                        <input type="hidden" value="'.$info_ship->id_shipping.'" class="id_shipping_cf">

                         <div class="col-md-10">
                                <div class=" rounded  mb-md-0">
                                  <address class="mb-0 address-lg">
                                        <div class="form-check">           
                                          <label class="form-check-label font-16 fw-bold badge badge-outline-warning" for="customRadio1">
                                            <i class="dripicons-location"></i>
                                              '.$info_ship->type_shipping.'</label>
                                         </div>
                                         <span class="fw-semibold">'.$info_ship->name_shipping.': </span> 
                                                          '.$info_ship->desc_address.' , '.$info_ship->address_shipping.'     <br>        
                                      <span class="font-16 fw-bold" title="Phone">Phone(<i class="dripicons-phone"></i>):</span> '.$info_ship->phone_shipping.' <br>
                                   </address>
                               </div>
                                <hr>  
                            </div>

                            <div class="col-md-1">
                            <button type="button" id="change_shippingxcc" data-bs-toggle="modal" 
                            data-bs-target="#centermodal" class="btn btn-info btn-sm btn-rounded change_shippingxcc">Changes</button>
                           </div>
                            
                    ';

               }
       

            }else{
              $output.='  ';

            }
       
      
        echo $output;


    }
    public function load_all_info_delivery_checkout(){
         $id_user = Auth::user()->id;
          $info_ship = tb_shipping::select('id_shipping','type_shipping','name_shipping','address_shipping','desc_address', 'phone_shipping','check_shipping')
         ->where('id_user', $id_user)->orderby('check_shipping','DESC')->get();

            $output = ''; 
            $count = $info_ship->count();
            if($count>0){
              foreach($info_ship as $key => $info_ship){ 
           
                $output .= ' 
                             <li class="list-group-item">
                                 <div class="row"> 
                                    <div class="col-md-10">
                                         <div class=" rounded  mb-md-0">
                                                     <address class="mb-0 address-lg">
                                                        <div class="form-check">'; 

                                                        if($info_ship->check_shipping == 1){
                                                         $output.='<input type="radio" checked id="customRadio1xs" name="customRadio_all" value="'.$info_ship->id_shipping.'" class="form-check-input check_default"> '; 
                                                          }else{
                                                              $output.='<input type="radio" id="customRadio1xs" name="customRadio_all" value="'.$info_ship->id_shipping.'" class="form-check-input check_default"> '; 
                                                          }

                                                         

                                                        $output.='
                                                          <label class="form-check-label font-16 fw-bold badge badge-outline-warning" for="customRadio1">
                                                            <i class="dripicons-location"></i>
                                                              '.$info_ship->type_shipping.'</label>
                                                         </div>
                                                         <span class="fw-semibold">'.$info_ship->name_shipping.': </span> 
                                                                         '.$info_ship->desc_address.' , '.$info_ship->address_shipping.'     <br>        
                                                      <span class="font-16 fw-bold" title="Phone">Phone(<i class="dripicons-phone"></i>):</span> '.$info_ship->phone_shipping.' <br>
                                                   </address>
                                              </div>
                                             </div>
                                           <div class="col-md-1 abcdas">
                                           <input type="hidden"  value="'.$info_ship->id_shipping.'" class="check_default">
                                            <button type="button" class="btn btn-outline-danger btn-rounded btn-sm edit_shippingxx">Edit</button>
                                          </div>  
                                           </div>
                                 </li>
                              
                    ';

               }
       

            }else{
              $output.='  ';

            }
       
      
        echo $output;


    }


    public function load_info_update_shipping_checkout(Request $request){
         $id_user = Auth::user()->id;

          $info_ship = tb_shipping::select('name_shipping','phone_shipping','address_shipping','desc_address', 'type_shipping')
         ->where('id_shipping',$request->id_ship)->where('id_user', $id_user)->get();
   
            foreach($info_ship as $key => $info_ship){ 

                $output['name_shipping'] = $info_ship->name_shipping; 
                $output['phone_shipping'] = $info_ship->phone_shipping;
                $output['address_shipping'] = $info_ship->address_shipping;
                $output['desc_address'] = $info_ship->desc_address;
                $output['type_shipping'] = $info_ship->type_shipping;
           

            }
       

       
      
        echo json_encode($output);


    }
    

    
        public function update_check_shipping_default(Request $request){
        
          $id_user = Auth::user()->id;

          $checkship = tb_shipping::where('id_user', $id_user)->where('check_shipping', 1)->get();


         tb_shipping::where('id_user',$id_user)->where('check_shipping', 1)->update(['check_shipping' => 0]);

         tb_shipping::where('id_shipping',$request->id_ship)->where('id_user',$id_user)->update(['check_shipping' => 1]);
        
       

     }


    public function save_edit_shipping_checkout(Request $request){
      
      $id_user = Auth::user()->id;
      $data = array();
      $data['name_shipping'] =$request->name_shipping;
      $data['phone_shipping'] =$request->phone_shipping;
      $data['address_shipping'] =$request->address_shipping;
      $data['desc_address'] =$request->desc_address;
      $data['type_shipping'] =$request->type_address;
      tb_shipping::where('id_shipping',$request->id_ship)->update($data);
    
     }

    

     public function add_shipping_checkout(Request $request){
      $data = $request->all();
      $id_user = Auth::user()->id;

        $checkship = tb_shipping::select('id_shipping')
         ->where('id_user', $id_user)->where('check_shipping', 1)->get();
        $count = $checkship->count();
        $ship = 1;
        if ($count>0) {
        $ship = 0;
        }

      $shipping = new tb_shipping();
      $shipping->id_user = $id_user;
      $shipping->name_shipping = $request->name_shipping;
      $shipping->phone_shipping = $request->phone_shipping;
      $shipping->address_shipping = $request->address_shipping;
      $shipping->desc_address = $request->desc_address;
      $shipping->type_shipping = $request->type_address;
      $shipping->check_shipping = $ship;
      $shipping->save();
    
     }



    public function select_delivery_home(Request $request){
      $data = $request->all();
      if($data['action']){
        $output = '';
        // dd($data['ma_id']);
        if($data['action']=="city"){
          $select_province = Province::select('maqh','name','type', 'matp')
         ->where('matp', $data['ma_id'])->orderby('maqh','ASC')->get();
          $output.='<option value="">---Chọn quận huyện---</option>';
          foreach($select_province as $key => $province){
            $output.='<option class="Province_op" value="'.$province->maqh.'">'.$province->name.'</option>';
          }

        }else{
          $select_wards = Wards::select('xaid','name','type', 'maqh')
         ->where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
          $output.='<option value="" >---Chọn xã phường---</option>';
          foreach($select_wards as $key => $ward){
            $output.='<option class="Wards_op" value="'.$ward->xaid.'">'.$ward->name.'</option>';
          }
        }
        echo $output;
      }

    }

}

<?php

namespace App\Http\Controllers;

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

class CartController extends Controller
{
    
    public function go_to_cart(){
         return view('user.shopping.Cart_page');
    }
 

     public function add_to_cart(Request $request){
        $id_product = $request->id_product;
        $id_user = Auth::user()->id;
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

    }

     public function load_qty_pro_cart(){
     $id_user = Auth::user()->id;
      $qtypro = tb_cart::select('id_cart')->where('id_user', $id_user)->where('check_item', '<', 2)->get();
     $qty = $qtypro->count();

     $output['qty_pro'] = $qty;

     echo json_encode($output); 

    }
    public function load_pro_cart_layout(){
     $id_user = Auth::user()->id;
      $qtypros = tb_cart::where('id_user', $id_user)->where('check_item', '<', 2)
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
                         $'.$total.'.000đ
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

     public function load_pro_cart_page(){
     $id_user = Auth::user()->id;
      $qtypros = tb_cart::where('id_user', $id_user)->where('check_item', '<', 2)
        ->join('tb_product_store','tb_cart.id_product','=','tb_product_store.id_product')
        ->select('tb_product_store.type_product', 'tb_product_store.name_product','tb_product_store.image_product','tb_product_store.price_product',
           'tb_cart.id_product','tb_cart.qty_product','tb_cart.id_cart','tb_cart.id_type_product','tb_cart.id_size_product','tb_cart.check_item')
        ->orderBy('id_cart', "DESC")->get();
      
            $output = ''; 
            $count = $qtypros->count();
            if($count>0){
              foreach($qtypros as $key => $qtypro){ 
               $total = $qtypro->qty_product * $qtypro->price_product;

                  if($qtypro->check_item == 0){
                 

                       
                    if($qtypro->type_product == 0){
                        $qtymx = tb_product_store::where('id_product', $qtypro->id_product)->select('price_product','qty_product')->first();
                         $total = $qtypro->qty_product * $qtymx->price_product; 

                            if($qtypro->qty_product > $qtymx->qty_product){
                              tb_cart::where('id_cart', $qtypro->id_cart)->update(['check_item' => 0]);
                               $output .= '
                                <tr>   
                                  <td>
                                   <span class="badge badge-outline-danger">Out of stock</span>
                                  </td>  
                                
                                  ';

                                }else{
                                  $output .= '
                                  <tr>
                                   <td>
                                   <div class="checkbox_iteam">
                                   <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartkk">
                                    <input  type="checkbox" class="form-check-input check_item" id="customCheck3" value="'.$qtypro->id_cart.'">
                                   </div>
                                  </td>
                                 
                                  ';
                                  }                      
                           $output .= '
                               <td>
                                <img src="'.asset('/uploadproduct/'.$qtypro->image_product).'" alt="contact-img" title="contact-img" class="rounded me-3" height="64">
                                  <p class="m-0 d-inline-block align-middle font-16">
                                 <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body">'.$qtypro->name_product.'</a>
                                  <br></p>
                               </td>
                               <td class="price_itemx">
                                <span class="price_item">'.$qtypro->price_product.'.000đ</span>
                               </td>
                                <td>
                                <div class="input-counter">
                                    <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartxx">
                                    <input type="hidden" min="1" value="'.$qtymx->qty_product.'" class="max_qtypro">
                                    <span  class="input-counter__minus fas fa-minus cart_quantity_down"></span>

                                     <input class="input-counter__text input-counter--text-primary-style " type="text"value="'.$qtypro->qty_product.'" data-min="1" data-max="'.$qtymx->qty_product.'">

                                     <span  class="input-counter__plus fas fa-plus cart_quantity_up"></span>
                                </div>
                                </td>
                           
                                <td class="qty_cart_pagex">
                                  <span class="qty_cart_page">'.$total.'.000đ</span>
                                 
                                </td>

                        ';

                        }else if($qtypro->type_product == 1){
                          $type = tb_type_product::select('name_type_pro', 'price_type_product','qty_type_product')->where('id_type_pro', $qtypro->id_type_product)
                          ->first();
                         $total = $qtypro->qty_product * $type->price_type_product;

                          if($qtypro->qty_product > $type->qty_type_product){
                                tb_cart::where('id_cart', $qtypro->id_cart)->update(['check_item' => 0]);
                            $output .= '
                                <tr>   
                                  <td>
                                   <span class="badge badge-outline-danger">Out of stock</span>
                                  </td>  
                                
                                  ';

                                }else{
                                  $output .= '
                                  <tr>
                                   <td>
                                   <div class="checkbox_iteam">
                                   <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartkk">
                                    <input  type="checkbox" class="form-check-input check_item" id="customCheck3" value="'.$qtypro->id_cart.'">
                                   </div>
                                  </td>
                                 
                                  ';

                              }     
                          $output .= '
                               <td>
                                <img src="'.asset('/uploadproduct/'.$qtypro->image_product).'" alt="contact-img" title="contact-img" class="rounded me-3" height="64">
                                  <p class="m-0 d-inline-block align-middle font-16">
                                 <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body">'.$qtypro->name_product.'</a>
                                  <br>
                                  <span class="badge badge-outline-warning">'.$type->name_type_pro.'</span></p>
                               </td>
                               <td class="price_itemx">
                                <span class="price_item">'.$type->price_type_product.'.000đ</span>
                               </td>
                                <td>
                                <div class="input-counter">
                                    <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartxx">
                                    <input type="hidden" min="1" value="'.$type->qty_type_product.'" class="max_qtypro">

                                    <span  class="input-counter__minus fas fa-minus cart_quantity_down"></span>

                                     <input readonly class="input-counter__text input-counter--text-primary-style" type="text" value="'.$qtypro->qty_product.'" data-min="1" data-max="'.$type->qty_type_product.'">

                                     <span  class="input-counter__plus fas fa-plus cart_quantity_up"></span>
                                </div>
                                </td>
                           
                                <td class="qty_cart_pagex">
                                  $<span class="qty_cart_page">'.$total.'.000đ</span>
                                 
                                </td>

                        ';

                      }else if($qtypro->type_product == 2){

                          $size = tb_size_product::where('id_size_pro', $qtypro->id_size_product)
                          ->join('tb_type_product','tb_size_product.id_type_pro','=','tb_type_product.id_type_pro')
                          ->select('tb_size_product.name_size', 'tb_size_product.price_size_product', 'tb_type_product.name_type_pro','tb_size_product.qty_size_product')
                           ->first();
                          //     $size = tb_size_product::where('id_size_pro', $qtypro->id_size_product)
                          //     ->join('tb_type_product','tb_size_product.id_type_pro','=','tb_type_product.id_type_pro')
                          //     ->select('tb_size_product.name_size', 'tb_size_product.price_size_product', 'tb_type_product.name_type_pro','tb_size_product.qty_size_product')
                          //     ->first();

                               $total = $qtypro->qty_product * $size->price_size_product;
                                 if($qtypro->qty_product > $size->qty_size_product ){
                                     tb_cart::where('id_cart', $qtypro->id_cart)->update(['check_item' => 0]);
                                 $output .= '
                                  <tr>   
                                    <td>
                                     <span class="badge badge-outline-danger">Out of stock</span>
                                    </td>  
                                  
                                    ';

                                  }else{
                                    $output .= '
                                    <tr>
                                     <td>
                                     <div class="checkbox_iteam">
                                     <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartkk">
                                      <input  type="checkbox" class="form-check-input check_item" id="customCheck3" value="'.$qtypro->id_cart.'">
                                     </div>
                                    </td>
                                   
                                    ';

                                  }    
                                    
                          $output .= '
                             <td>
                              <img src="'.asset('/uploadproduct/'.$qtypro->image_product).'" alt="contact-img" title="contact-img" class="rounded me-3" height="64">
                                <p class="m-0 d-inline-block align-middle font-16">
                               <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body">'.$qtypro->name_product.'</a>
                                <br>  <span class="badge badge-outline-warning">'.$size->name_type_pro.' , '.$size->name_size.'</span></p>
                             </td>
                               <td class="price_itemx">
                                <span class="price_item">'.$size->price_size_product.'.000đ</span>
                               </td>
                                <td>
                                <div class="input-counter">
                                    <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartxx">
                                    <input type="hidden" min="1" value="'.$size->qty_size_product.'" class="max_qtypro">

                                    <span  class="input-counter__minus fas fa-minus cart_quantity_down"></span>

                                     <input readonly class="input-counter__text input-counter--text-primary-style" type="text" value="'.$qtypro->qty_product.'" data-min="1" data-max="'.$size->qty_size_product.'">

                                     <span  class="input-counter__plus fas fa-plus cart_quantity_up"></span>
                                </div>
                                </td>
                           
                                <td class="qty_cart_pagex">
                                  <span class="qty_cart_page">'.$total.'.000đ</span>
                                 
                                </td>

                        ';      
                   }
        }else {

                  if($qtypro->type_product == 0){
                        $qtymx = tb_product_store::where('id_product', $qtypro->id_product)->select('qty_product')->first();
                         $total = $qtypro->qty_product * $qtypro->price_product; 

                            if($qtypro->qty_product > $qtymx->qty_product){
                              tb_cart::where('id_cart', $qtypro->id_cart)->update(['check_item' => 0]);
                               $output .= '
                                <tr>   
                                  <td>
                                   <span class="badge badge-outline-danger">Out of stock</span>
                                  </td>  
                                
                                  ';

                                }else{
                                  $output .= '
                                  <tr>
                                   <td>
                                   <div class="checkbox_iteam">
                                   <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartkk">
                                    <input  type="checkbox" class="form-check-input check_item" id="customCheck3" checked value="'.$qtypro->id_cart.'">
                                   </div>
                                  </td>
                                 
                                  ';}                       
                           $output .= '
                               <td>
                                <img src="'.asset('/uploadproduct/'.$qtypro->image_product).'" alt="contact-img" title="contact-img" class="rounded me-3" height="64">
                                  <p class="m-0 d-inline-block align-middle font-16">
                                 <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body">'.$qtypro->name_product.'</a>
                                  <br></p>
                               </td>
                               <td class="price_itemx">
                                <span class="price_item">'.$qtypro->price_product.'.000đ</span>
                               </td>
                                <td>
                                <div class="input-counter">
                                    <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartxx">
                                    <input type="hidden" min="1" value="'.$qtymx->qty_product.'" class="max_qtypro">
                                    <span  class="input-counter__minus fas fa-minus cart_quantity_down"></span>

                                     <input class="input-counter__text input-counter--text-primary-style " type="text"value="'.$qtypro->qty_product.'" data-min="1" data-max="'.$qtymx->qty_product.'">

                                     <span  class="input-counter__plus fas fa-plus cart_quantity_up"></span>
                                </div>
                                </td>
                           
                                <td class="qty_cart_pagex">
                                  <span class="qty_cart_page">'.$total.'.000đ</span>
                                 
                                </td>

                        ';

                        }else if($qtypro->type_product == 1){
                          $type = tb_type_product::select('name_type_pro', 'price_type_product','qty_type_product')->where('id_type_pro', $qtypro->id_type_product)
                          ->first();
                         $total = $qtypro->qty_product * $type->price_type_product;

                          if($qtypro->qty_product > $type->qty_type_product){
                                tb_cart::where('id_cart', $qtypro->id_cart)->update(['check_item' => 0]);
                            $output .= '
                                <tr>   
                                  <td>
                                   <span class="badge badge-outline-danger">Out of stock</span>
                                  </td>  
                                
                                  ';

                                }else{
                                  $output .= '
                                  <tr>
                                   <td>
                                   <div class="checkbox_iteam">
                                   <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartkk">
                                    <input  type="checkbox" class="form-check-input check_item" id="customCheck3" checked value="'.$qtypro->id_cart.'">
                                   </div>
                                  </td>
                                 
                                  ';
                                }     
                          $output .= '
                               <td>
                                <img src="'.asset('/uploadproduct/'.$qtypro->image_product).'" alt="contact-img" title="contact-img" class="rounded me-3" height="64">
                                  <p class="m-0 d-inline-block align-middle font-16">
                                 <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body">'.$qtypro->name_product.'</a>
                                  <br>
                                  <span class="badge badge-outline-warning">'.$type->name_type_pro.'</span></p>
                               </td>
                               <td class="price_itemx">
                                <span class="price_item">'.$type->price_type_product.'.000đ</span>
                               </td>
                                <td>
                                <div class="input-counter">
                                    <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartxx">
                                    <input type="hidden" min="1" value="'.$type->qty_type_product.'" class="max_qtypro">

                                    <span  class="input-counter__minus fas fa-minus cart_quantity_down"></span>

                                     <input readonly class="input-counter__text input-counter--text-primary-style" type="text" value="'.$qtypro->qty_product.'" data-min="1" data-max="'.$type->qty_type_product.'">

                                     <span  class="input-counter__plus fas fa-plus cart_quantity_up"></span>
                                </div>
                                </td>
                           
                                <td class="qty_cart_pagex">
                                  <span class="qty_cart_page">'.$total.'.000đ</span>
                                 
                                </td>

                        ';

                      }else if($qtypro->type_product == 2){

                          $size = tb_size_product::where('id_size_pro', $qtypro->id_size_product)
                          ->join('tb_type_product','tb_size_product.id_type_pro','=','tb_type_product.id_type_pro')
                          ->select('tb_size_product.name_size', 'tb_size_product.price_size_product', 'tb_type_product.name_type_pro','tb_size_product.qty_size_product')
                          ->first();
                              $size = tb_size_product::where('id_size_pro', $qtypro->id_size_product)
                              ->join('tb_type_product','tb_size_product.id_type_pro','=','tb_type_product.id_type_pro')
                              ->select('tb_size_product.name_size', 'tb_size_product.price_size_product', 'tb_type_product.name_type_pro','tb_size_product.qty_size_product')
                              ->first();
                               $total = $qtypro->qty_product * $size->price_size_product;
                                 if($qtypro->qty_product > $size->qty_size_product ){
                                     tb_cart::where('id_cart', $qtypro->id_cart)->update(['check_item' => 0]);
                                 $output .= '
                                  <tr>   
                                    <td>
                                     <span class="badge badge-outline-danger">Out of stock</span>
                                    </td>  
                                  
                                    ';

                                  }else{
                                    $output .= '
                                    <tr>
                                     <td>
                                     <div class="checkbox_iteam">
                                     <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartkk">
                                      <input  type="checkbox" class="form-check-input check_item" id="customCheck3" checked value="'.$qtypro->id_cart.'">
                                     </div>
                                    </td>
                                   
                                    ';

                                  }    
                                    
                          $output .= '
                             <td>
                              <img src="'.asset('/uploadproduct/'.$qtypro->image_product).'" alt="contact-img" title="contact-img" class="rounded me-3" height="64">
                                <p class="m-0 d-inline-block align-middle font-16">
                               <a href="'.url('/detail_products/'.$qtypro->id_product).'" class="text-body">'.$qtypro->name_product.'</a>
                                <br>  <span class="badge badge-outline-warning">'.$size->name_type_pro.' , '.$size->name_size.'</span></p>
                             </td>
                               <td class="price_itemx">
                                <span class="price_item">'.$size->price_size_product.'.000đ</span>
                               </td>
                                <td>
                                <div class="input-counter">
                                    <input type="hidden" min="1" value="'.$qtypro->id_cart.'" class="id_cartxx">
                                    <input type="hidden" min="1" value="'.$size->qty_size_product.'" class="max_qtypro">

                                    <span  class="input-counter__minus fas fa-minus cart_quantity_down"></span>

                                     <input readonly class="input-counter__text input-counter--text-primary-style" type="text" value="'.$qtypro->qty_product.'" data-min="1" data-max="'.$size->qty_size_product.'">

                                     <span  class="input-counter__plus fas fa-plus cart_quantity_up"></span>
                                </div>
                                </td>
                           
                                <td class="qty_cart_pagex">
                                  <span class="qty_cart_page">'.$total.'.000đ</span>
                                 
                                </td>

                        ';      
                   }
            

                }     



                     
                     $output .= ' 
                       <td class= "id_cartxxssa">
                            <input class="id_cartxx" type="hidden" value="'.$qtypro->id_cart.'" >
                             <a  id="'.$qtypro->id_cart.'"  class="action-icon delete_item_cart"> <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>          
                    ';
           
             

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



       public function load_info_checkout_cart(){
          $id_user = Auth::user()->id;
          $qtypros = tb_cart::select('id_cart','id_product','type_product','qty_product','id_type_product','id_size_product')
          ->where('id_user', $id_user)->where('check_item', 1)->get();
         
            
            $count = $qtypros->count();
            if($count>0){
                $total_cart = 0;
                foreach($qtypros as $key => $qtypr){

                  if($qtypr->type_product == 0){
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
                $a = 19; $b = 9; $c = 5;

                $output['Grand_total'] = $total_cart;
                $output['Discount'] = round(($a/100)*$total_cart, 1);
                $output['Shipping_ch'] =  round(($b/100)*$total_cart, 1);
                $output['Estimated_tax'] =  round(($c/100)*$total_cart, 1);
                $output['Total'] = round($total_cart - (round(($a/100)*$total_cart, 1) +  round(($b/100)*$total_cart, 1) +  round(($c/100)*$total_cart, 1)));


                $output['pt_dis'] = $a;
                $output['pt_ship'] =  $b;
                $output['pt_tax'] =  $c;

            }else{

                $output['Grand_total'] =0;
                $output['Discount'] = 0;
                $output['Shipping_ch'] = 0;
                $output['Estimated_tax'] = 0;
                $output['Total'] =  0;

                $output['pt_dis'] = 0;
                $output['pt_ship'] =  0;
                $output['pt_tax'] =  0;
            }

             echo json_encode($output);     
          
       }

       public function checked_iteam(Request $request){
         $id_cart = $request->id_cart;
         $updatsse = $request->checkedd;
         $data = array(); 
         $data['check_item'] = $updatsse;
         tb_cart::where('id_cart', $id_cart)->update($data);
          
       }
       

       public function update_quanty(Request $request){
         $id_cart = $request->id_cart;
         $qty = $request->qty;

         $data = array(); 
         $data['qty_product'] = $qty;
         tb_cart::where('id_cart', $id_cart)->update($data);
          
       }

       public function delete_item_cart(Request $request){
         $id_cart = $request->id_cart;
        $tb_cart = tb_cart::find($id_cart);  
        $tb_cart->delete();
       }
  









}

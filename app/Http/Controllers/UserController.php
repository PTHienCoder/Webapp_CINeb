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
use App\tb_chat;


class UserController extends Controller
{
   ////////////////// dang nhap, dang ky, dang xuat
   public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect('ShowDashboardAdmin');
        }else{
            return redirect('adminreset')->send();
        }

       }
    public function LoginUser (){

     return view('user.Login_user');
    }

    public function PostLoginUser(Request $request){
       $data = $request->validate(
            [
                'email' => 'required|email|max:255',
                'password' => 'required|min:6'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute độ dài tối đa :max',
                'email' => ':attribute dữ liệu nhập vào phải là email'
            ],
            [
                'email' => 'Email',
                'password' => 'Password'
            ]
        );

       $remember = false;
        if ($request->remembers) {
            $remember = true;
        }
        if(Auth::attempt($data, $remember)){

            if(Auth::user()->status == 0){
              Auth::logout();
              return redirect()->back()->withErrors(['msg' => 'Account No VerifyEmail.']);

            }else{
                 return redirect('/'); 
            }

         
        }else{
            return redirect()->back()->with('message', 'Email or Password is wrong. Please re-enter');
        }
          

    }
    public function SignupUser (){
     return view('user.Signup_user');
    }

     public function PostSignupUser(UserRequest $request){
           $data = $request->all();
 
            $passw = Hash::make($data['password']);

            $query = new User();
            $query->name = $data['nickname'];
            $query->email = $data['email'];
            $query->password = $passw;
            $query->phone_user = 0;
            $query->image_user = 0;
            $query->birthday = 0;
            $query->type_user = 0;
            $query->story = "...";
            $query->status = 1;        
            $query->token = strtoupper(Str::random(20));
                

         if($query->save()){
                $data = [
                'id' => $query->id,
                'name' => $query->nickname,
                'email' => $query->email
                ];

               // Mail::to($query->email)->send(new VerifyEmail($data));

               return redirect('/LoginUser'); 
            }else{
              return redirect()->back(); 
            }

    }

    public function VerifyEmail(Request $request, $id){
          User::where('id', $id)->update(['status' => 1]);
          return view('user.Mail.VerifyEmail_Success');
    }



     public function logoutuser(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');

    }


    //////////////////////////////////

    public function Chat_Page($id_fr){
     return view('user.Chat')->with("id_fr", $id_fr);
    }

     public function post_chat(Request $request){
         $now = Carbon::now('Asia/Ho_Chi_Minh');
            $query = new tb_chat();
            $query->id_user = Auth::user()->id;
            $query->id_friends = $request->id_fr;
            $query->content = $request->content_chat;
            $query->time_chat = $now;
            $query->save();


    }
     public function loadstore_Chat_user(Request $request){
      $user_chat = tb_chat::where('id_friends', Auth::user()->id)
                   ->join('tb_store', 'tb_chat.id_user','tb_store.id_store')->get()->unique('id_user');

                   // dd($user_chat->count());

       $output = '';
        if($user_chat->count() >0 ){
           foreach($user_chat as $key => $user_chat){
              $output .= ' <a  class="text-body item_user" >
                                              <input type="hidden" class="id_store" value="'.$user_chat->id_store.'">
                                                                <div class="d-flex align-items-start mt-1 p-2">
                                                                    <img src="'.asset('/uploads/store/'.$user_chat->avt_store).'" class="me-2 rounded-circle" height="48" alt="Brandon Smith">
                                                                    <div class="w-100 overflow-hidden">
                                                                        <h5 class="mt-0 mb-0 font-14">
                                                                   
                                                                            '.$user_chat->name_store.'
                                                                        </h5>
                                                                        <p class="mt-1 mb-0 text-muted font-14">
                                                                            
                                                                            <span class="w-75">'.$user_chat->content.'</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </a>';


          }

        }else{
           $output .= '';
        }          
       

          echo $output;

    }


    public function load_Infor_store_chat(Request $request){
    $store = tb_store::where('id_store', $request->id_store)
    ->join('users', 'tb_store.id_user','users.id')->first();

    // dd($request->id_store);
     $output['image_store'] = ' <img src="'.asset('/uploads/store/'.$store->avt_store).'" alt="shreyu" class="img-thumbnail avatar-lg rounded-circle">';
     $output['name_store'] = $store->name_store;
     $output['email'] = $store->email;
     $output['location'] = $store->address_store;
     $output['phone'] = $store->phone_store;


    
     $output['data_chat'] = '';
     $all_chat = tb_chat::where('id_user', Auth::user()->id)->orwhere('id_friends', Auth::user()->id)->orderby('id_chat', "DESC")->get();
       foreach($all_chat as $key => $all_chat){
          if($all_chat->id_user == Auth::user()->id && $all_chat->id_friends == $request->id_store){
          
            $output['data_chat'] .= '<li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="'.asset('/uploads/profile/'.Auth::user()->id.'/'.Auth::user()->image_user).'" class="rounded" alt="dominic">
                                                    <i>'.$all_chat->time_chat.'</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i> '.Auth::user()->name.'</i>
                                                        <p>
                                                          '.$all_chat->content.'
                                                        </p>
                                                    </div>
                                                </div>
                                              
                                            </li>';
          }else if($all_chat->id_user == $request->id_store && $all_chat->id_friends == Auth::user()->id){

                  $inf_store = tb_store::where('id_store', $request->id_store)->first();

                 $output['data_chat'] .= '<li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="'.asset('/uploads/store/'.$inf_store->avt_store).'" class="rounded" alt="Shreyu N">
                                                    <i>'.$all_chat->time_chat.'</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i> '.$inf_store->name_store.' </i>
                                                        <p>
                                                           '.$all_chat->content.'
                                                        </p>
                                                    </div>
                                                </div>
                                               
                                            </li>';

          }


       }
   
      
 
 

      echo json_encode($output);
    }





////////////////////////////////////////// FOLLOW USER /////////////////////////////////////////////////////


public function Load_btn_follow(Request $request){
 
    $output ='';
         if (!Auth::user()){
           $output .='';
         }else if( Auth::user()->id ==  $request->id_user){

            $output .='';

         }else{
                    $flw = tb_follow_user::where('id_user', Auth::user()->id)->where('id_friends', $request->id_user)->first();
                    if ($flw) {
                        $output .='<button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn_followed">followed</button>';
                    }else{
                        $output .='<button type="button" class="btn btn-sm btn-primary btn-rounded btn_Follow">Follow</button>';
                    }
         }
   echo $output;

  
} 
public function btn_follow_user(Request $request){
     $mytime = Carbon::now('Asia/Ho_Chi_Minh');

   $fl = new tb_follow_user();   
   $fl->id_user = Auth::user()->id;
   $fl->id_friends = $request->id_user;
   $fl->time_add = $mytime;
   $fl->save();  
} 
public function btn_Nofollow_user(Request $request){
    
 tb_follow_user::where('id_user', Auth::user()->id)->where('id_friends', $request->id_user)->delete();
  
} 






//////////////////////////////////////////////////////////////

    public function loadtypeuser(){
      $idusser = Auth::user()->id; 
      $getuser = tb_user::select('type_user')
               ->where('id', $idusser)->first();

      $output ='';
      if($getuser){
            if($getuser->type_user == 0){
                     $output .= '
                             <a data-bs-toggle="modal" data-bs-target="#modal_createShop">
                                 <i class="mdi mdi-store-plus"></i>
                                <span >Create store</span>
                             </a>
                        ';


                  }else if($getuser->type_user == 1){
                       $output .= '
                             <a id="hreapsds">
                                   <i class="uil-shop me-1"></i>
                                    <span class="myst">My store</span>
                             </a>
                        ';


                  }else if($getuser->type_user == 2) {
                       $output .= '
                             <a href="#" >
                               <span class="myst">Approved ...</span>
                            </a>
                        ';

                  }else{
                       $output .= '
                             <a href="#" >
                               <span class="myst">Approved failed...</span>
                            </a>
                        ';

                  }


      }
     
        echo $output;

   }

     public function load_category_store(){
   
      $areas = tb_business_areas::select('id_areas','name_areas')
               ->orderBy('id_areas','DESC')->get();

    
         $output ='';
         $output .= '
             <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm ">Business areas</label>
                 <div class="col-sm-9" >
                <select  name="cate_store" class="form-select mb-3 Category_store">    
            ';
    
           foreach($areas as $key => $areas){
                $output .= '
                         <option value="'.$areas->id_areas.'">'.$areas->name_areas.'</option>   
                    ';
               }

           $output .= '
                </select>
              </div>
          ';
        


        echo $output;

   }


   //////////////////////

      public function uploads_ckeditor(Request $request){
       if($request->hasFile('upload')) {


            $get_image= $request->file('upload');

            $get_name_image =rand(0,99). '_' .$get_image->getClientOriginalName();
            $path = public_path('uploads/ckeditor/'.$get_name_image);

            Image::make($get_image->getRealPath())->fit(400, 400)->save($path);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('/uploads/ckeditor/'.$get_name_image); 
            $msg = 'Tải ảnh thành công'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;

        }
    }


   //     public function file_browser(Request $request){
   //      $paths = glob(public_path('uploads/ckeditor/*'));

   //      $fileNames = array();

   //      foreach($paths as $path){
   //          array_push($fileNames,basename($path));
   //      }
   //      $data = array(
   //          'fileNames' => $fileNames
   //      );
       
   //      return view('image.file_browser')->with($data);
   // }
   

}

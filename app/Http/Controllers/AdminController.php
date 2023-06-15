<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Session;
use App\tb_admin;
use App\tb_store;
use App\tb_user;
use App\tb_field_project;
use App\tb_business_areas;
use App\tb_product_store;
use App\tb_size_product;
use App\tb_type_product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
class AdminController extends Controller
{
      public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect('ShowDashboardAdmin');
        }else{
            return redirect('adminreset')->send();
        }

       }

      public function indexreset(){
         return view('admin.Login_admin');
        }

      public function index(){
           $admin_id = Session::get('admin_id');
            if($admin_id){
               return redirect('ShowDashboardAdmin');
            }else{
                return redirect('adminreset');
            }
        
        }
   
       public function LoginAdmin(Request $request){
         $data = $request->all();
    
        $email_admin = $data['email_admin'];
        $admin_password = md5($data['admin_password']);

        $login = tb_admin::where('email_admin',$email_admin)->where('password',$admin_password)->first();
        if($login){
            $login_count = $login->count();
            if($login_count>0){
                Session::put('email_admin',$login->email_admin);
                Session::put('admin_id',$login->id_admin);
                return redirect('ShowDashboardAdmin');
            }
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
                return redirect('adminreset');
        }

       }

        public function logout(){
            $this->AuthLogin();
            Session::put('email_admin',null);
            Session::put('admin_id',null);
            return redirect('admin');
        }
       

        public function ShowDashboardAdmin(){
         //  $this->AuthLogin();
          return view('admin.index');
              
        }
        

        public function Project_management(){
         //  $this->AuthLogin();
          return view('admin.Project_management');
              
        } 

        public function Product_management(){
         //  $this->AuthLogin();
          return view('admin.Product_management');
              
        }
        public function user_management(){
         //  $this->AuthLogin();
          $Us = tb_user::get();
          return view('admin.user_management')->with('load_user', $Us);
              
        } 

     public function load_products_manager_admin(){
         
    $load_pro = tb_product_store::join('tb_category_product','tb_category_product.id_cate_product','=','tb_product_store.id_cate_store')
    ->orderBy('id_product','DESC')->get();
      $output = '';
      if($load_pro->count()>0){
                    foreach($load_pro as $key => $vid){
               
                            $output.='   
                              <tr>
                              <td>
                                <img src="'.asset('/uploadproduct/'.$vid->image_product).'" class="img-thumbnail" width="50" height="50">
                                <p class="m-0 d-inline-block align-middle font-15" style="overflow-wrap: break-word; width: 250px;>
                                   <a class="text-body">  
                                       '.$vid->name_product.'</a>
                                       <br>
                                                            
                                 </p>
                              </td>
                               <td class="a">'.$vid->name_cate_product.'</td>
                        
                               '; 


                                if($vid->type_product == 0){
                        

                                      $output.='
                                      <td>'.$vid->date_time.'</td> 
                                      <td><span class="badge badge-outline-secondary">No attribute</span> </td>    
                                      <td>'.$vid->price_product.'.000đ</td>    
                                      <td>'.$vid->qty_product.'</td>    
                                       
                                    
                                     </tr>'; 

                                }else if($vid->type_product == 1){
                                      $min = tb_type_product::where('id_product', $vid->id_product)
                                      ->min('price_type_product');
                                      $max = tb_type_product::where('id_product', $vid->id_product)
                                      ->max('price_type_product');
                                      $sum = tb_type_product::where('id_product', $vid->id_product)->max('qty_type_product');


                                      $output.='
                                      <td>'.$vid->date_time.'</td>
                                      <td><span class="badge badge-outline-primary">1 attribute </span></td>    
                                      <td>'.$min.'.000đ - '.$max.'.000đ</td>   
                                      <td>'.$sum.'</td>    
                                     

                                   
                                     </tr>'; 
                                }else if($vid->type_product == 2){
                                      $min = tb_size_product::where('id_product', $vid->id_product)->min('price_size_product');
                                      $max = tb_size_product::where('id_product', $vid->id_product)->max('price_size_product');
                                      $sum = tb_size_product::where('id_product', $vid->id_product)->max('qty_size_product');


                                      $output.='
                                     <td>'.$vid->date_time.'</td>
                                      <td> <span class="badge badge-outline-danger">2 attribute </span></td>    
                                      <td>'.$min.'.000đ - '.$max.'.000đ</td>    
                                      <td>'.$sum.'</td>     
                                    
                                     </tr>'; 
                                }
                     


                    }


                    }else{ 
                    $output.='
                              <tr>
                                   <td colspan="4">No item</td>
                                               
                              </tr>


                        ';

                }

         echo $output;
              
        }  



///////////// quan ly  cac cua hang store 

        public function store_manager(){
         // $this->AuthLogin();
         // $store = tb_store::where('type_store', 0)->orderBy('id_store','DESC')->get();;
        return view('admin.store_manager');
              
        } 
         public function load_store_old(){
         $load_store = tb_store::where('type_store',1)
         ->join('users','users.id','=','tb_store.id_user')
         ->join('tb_business_areas','tb_business_areas.id_areas','=','tb_store.Category_store')
         ->orderBy('id_store','DESC')->get();
              $load_store_count = $load_store->count();
              $output ='';
              $output = '<form>
                            '.csrf_field().'                          
                                          <div class="row">
                                            <div class="col-sm-12 col-md-9"></div>
                                            <div class="col-sm-12 col-md-3">
                                                <div id="scroll-vertical-datatable_filter" class="dataTables_filter">
                                                    <label>Search:
                                                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="scroll-vertical-datatable">
                                                    </label>
                                                </div>
                                            </div>
                                          </div>
                                           <table id="scroll-vertical-datatable" class="table dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                       <th>STT</th>
                                                        <th>Name</th>
                                                        <th>Category</th>              
                                                        <th>phone</th>
                                                        <th>Address</th>
                                                        <th>Owner</th>
                                                        <th>image</th>
                                         
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                ';
                if($load_store_count>0){
                    $i = 0;
                    foreach($load_store as $key => $vid){
                        $i++;
                        $output.='

                             <tr>
                              <td>'.$i.'</td>
                               <td>'.$vid->name_store.'</td>
                               <td>'.$vid->name_areas.'</td>

                               <td>'.$vid->phone_store.'</td>
                               <td>'.$vid->address_store.'</td>
                               <td>'.$vid->email_user.'</td>

                                <td>
                                <img src="'.asset('/uploads/store/'.$vid->avt_store).'" class="img-thumbnail" width="80" height="80">
                 
                                </td>

                               
                               <td><button onclick="view_store_old(this.id);" id="'.$vid->id_store.'" data-bs-toggle="modal" data-bs-target="#info-header-modal" type="button" data-id_store="'.$vid->id_store.'"  
                                   class="btn-xs btn btn-primary btn-view-store">Views</button></td>
                             </tr>
                                            

                        ';
                    }
                }else{ 
                    $output.='
                             <tr>
                                   <td colspan="4">Chưa có store nào hết</td>
                                               
                              </tr>


                        ';

                }
                $output.='
                         </tbody>
                        </table>
                    </form>
                        ';
                echo $output;
            }
              
        public function view_store_old(Request $request){

        $id_store = $request->id_store;

          $store = tb_store::where('id_store',$id_store)
         ->join('users','users.id','=','tb_store.id_user')
         ->join('tb_business_areas','tb_business_areas.id_areas','=','tb_store.Category_store')
         ->get();

        foreach($store as $key => $store){
           
       

        $output['image_user'] = '<img src="/uploads/profile/'.$store->id.'/'.$store->image_user.'" class="rounded-circle avatar-md img-thumbnail" alt="profile-image">';

        $output['nickname'] = $store->nickname;
        $output['email_user'] = $store->email;
        $output['birthday'] = $store->birthday;
        $output['phone_user'] = $store->phone_user;
        $output['story_user'] = $store->story_user;
           

        $output['name_store'] = $store->name_store;
        $output['Category_store'] = $store->name_areas;
        
        $output['phone_store'] = $store->phone_store;
        $output['cmnd_user'] = $store->cmnd_user;
        $output['address_store'] = $store->address_store;
        $output['desc_store'] = $store->desc_store;

        $output['avt_store'] = '<img alt="image" src="/uploads/store/'.$store->avt_store.'" 
         class="img-fluid img-thumbnail" width="200"/>';


      


        $output['foofetr'] = '


         <button type="button" onclick="No_Approve_store(this.id);" id="'.$store->id_store.'" data-id_store="'.$store->id_store.'" class="btn btn-danger" data-bs-dismiss="modal">Lock up</button>

         <button type="button" data-bs-dismiss="modal" class="btn btn-light">Close</button>

        ';

         }
      
        echo json_encode($output);     

    }

         public function load_store_new(){
         $load_store = tb_store::where('type_store',0)->orderBy('id_store','DESC')->get();
              $load_store_count = $load_store->count();
              $output ='';
              $output = '<form>
                            '.csrf_field().'                          
                                          <div class="row">
                                            <div class="col-sm-12 col-md-9"></div>
                                            <div class="col-sm-12 col-md-3">
                                            
                                            </div>
                                          </div>
                                           <table id="scroll-vertical-datatable" class="table dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Name</th>
                                                        <th>phone</th>
                                                        <th>image</th>
                                         
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                ';
                if($load_store_count>0){
                    $i = 0;
                    foreach($load_store as $key => $vid){
                        $i++;
                        $output.='

                             <tr>
                              <td>'.$i.'</td>
                               <td>'.$vid->name_store.'</td>

                               <td>'.$vid->phone_store.'</td>

                                <td>
                                <img src="'.asset('/uploads/store/'.$vid->avt_store).'" class="img-thumbnail" width="80" height="80">
                 
                                </td>

                               
                               <td><button onclick="view_storenew(this.id);" id="'.$vid->id_store.'" data-bs-toggle="modal" data-bs-target="#info-header-modal" type="button" data-id_store="'.$vid->id_store.'"  
                                   class="btn-xs btn btn-primary btn-view-store">Views</button></td>
                             </tr>
                                            

                        ';
                    }
                }else{ 
                    $output.='
                             <tr>
                                   <td colspan="4">Chưa có store nào hết</td>
                                               
                              </tr>


                        ';

                }
                $output.='
                         </tbody>
                        </table>
                    </form>
                        ';
                echo $output;
            }
              
        public function view_store_new(Request $request){

        $id_store = $request->id_store;

          $store = tb_store::where('id_store',$id_store)
         ->join('users','users.id','=','tb_store.id_user')
         ->join('tb_business_areas','tb_business_areas.id_areas','=','tb_store.Category_store')
         ->get();

        foreach($store as $key => $store){
           
    
        $output['image_user'] = '<img src="/uploads/profile/'.$store->id.'/'.$store->image_user.'" class="rounded-circle avatar-md img-thumbnail" alt="profile-image">';

        $output['nickname'] = $store->nickname;
        $output['email_user'] = $store->email;
        $output['birthday'] = $store->birthday;
        $output['phone_user'] = $store->phone_user;
        $output['story_user'] = $store->story_user;
           

        $output['name_store'] = $store->name_store;
        $output['Category_store'] = $store->name_areas;
        
        $output['phone_store'] = $store->phone_store;
        $output['cmnd_user'] = $store->cmnd_user;
        $output['address_store'] = $store->address_store;
        $output['desc_store'] = $store->desc_store;

        $output['avt_store'] = '<img alt="image" src="/uploads/store/'.$store->avt_store.'" 
         class="img-fluid img-thumbnail" width="200"/>';


      


        $output['foofetr'] = '
  
         <button type="button" onclick="Approve_store(this.id);" id="'.$store->id_store.'" data-id_store="'.$store->id_store.'" class="btn btn-info  " data-bs-dismiss="modal">Approve</button>

         <button type="button" onclick="No_Approve_store(this.id);" id="'.$store->id_store.'" data-id_store="'.$store->id_store.'" class="btn btn-danger" data-bs-dismiss="modal">Not approved</button>

         <button type="button" data-bs-dismiss="modal" class="btn btn-light">Close</button>

        ';

         }
      
        echo json_encode($output);
       

    }
    public function Approve_store(Request $request){
        $id_store = $request->id_store;
        
         $store = tb_store::find($id_store);
         $data = array();
         $mytime = Carbon::now('Asia/Ho_Chi_Minh');
         $data['time_add'] =$mytime;
         $data['type_store'] = 1;
         tb_store::where('id_store',$id_store)->update($data);
        
         $data1 = array();
         $data1['type_user'] = 1;
         tb_user::where('id',$store->id_user)->update(['type_user' => 1]);

    }


    public function No_Approve_store(Request $request){
         $id_store = $request->id_store;

         $store = tb_store::find($id_store);
         // $data = array();
         // $data['type_store'] = 3;
         tb_store::where('id_store',$id_store)->update(['type_store' => 3]);
        
         // $data1 = array();
         // $data1['type_user'] = 3;
         tb_user::where('id',$store->id_user)->update(['type_user' => 3]);
    }


         
 //////////////////// linh vuc du an


  public function Catalog_management(){
         $this->AuthLogin();

          return view('admin.Catalog_management');
              
   } 



  public function add_field_project(Request $request){

         $data = array(); 
         $data = $request->all();

         $field = new tb_field_project();
         $field->name_field = $data['name_field_pro'];
         $field->desc_field = $data['desc_field_pro'];
      
         $get_image = $request->file('file');
           if($get_image == null){
            $field->image_field = 'fieldpng.png';
            $field->save();
           }
           else {
                 $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
                 $path = public_path('uploads/category/'.$get_name_image);
                  Image::make($get_image->getRealPath())->fit(150, 150)->save($path);

         
                  $field->image_field = $get_name_image;
 
                  $field->save();
              
           }


      } 



      public function load_field_project(Request $request){
      $load_field = tb_field_project::orderBy('id_field','DESC')->get();
      $load_field_count = $load_field->count();
      $output ='';

      $output = ' <form>
                        '.csrf_field().'
                      <table id="scroll-vertical-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>  
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Describe</th>
                                    <th>image</th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody>

        ';
        if($load_field_count>0){
            $i = 0;
            foreach($load_field as $key => $vid){
                $i++;
                $output.='

                     <tr>
                      <td>'.$i.'</td>
                       <td>'.$vid->name_field.'</td>

                       <td>'.$vid->desc_field.'</td>

                        <td>
                        <img src="'.asset('/uploads/category/'.$vid->image_field).'" class="img-thumbnail" width="80" height="80">
         
                        </td>

                       
                       <td><button type="button" data-id_field="'.$vid->id_field.'"  class="btn btn-xs btn-danger btn-delete-field">Xóa</button></td>
                     </tr>
                                    

                ';
            }
        }else{ 
            $output.='
                     <tr>
                           <td colspan="4">Chưa có danh muc nào hết</td>
                                       
                      </tr>


                ';

        }
        $output.='
                 </tbody>
                </table>
            </form>


                ';
        echo $output;
      }

    public function delete_field(Request $request){
        $data = $request->all();
        $id_field = $data['id_field'];

        $field = tb_field_project::find($id_field);
        if($field->image_field != "fieldpng.png"){
           // unlink('/uploads/category/'.$field->image_field);
        }

     

        $field->delete();
    }


 ///////// linh vuc kinh doanh //////////////////


     public function add_business_areas(Request $request){

         $data = array(); 
         $data = $request->all();

         $areas = new tb_business_areas();
         $areas->name_areas = $data['name_business_areas'];
         $areas->desc_areas = $data['desc_business_areas'];
      



         $get_image = $request->file('file');
           if($get_image == null){
            $areas->image_areas = 'fieldpng.png';
            $areas->save();
           }
           else {

                 $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
                 $path = public_path('uploads/category/'.$get_name_image);
                  Image::make($get_image->getRealPath())->fit(150, 150)->save($path);

                  $areas->image_areas = $get_name_image;
 
                  $areas->save();
              
           }

        } 



      public function load_business_areas(Request $request){
      $load_areas= tb_business_areas::orderBy('id_areas','DESC')->get();
      $load_areas_count = $load_areas->count();
      $output ='';

      $output = ' <form>
                        '.csrf_field().'
                      <table id="scroll-vertical-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>  
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Describe</th>
                                    <th>image</th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody>

        ';
        if($load_areas_count>0){
            $i = 0;
            foreach($load_areas as $key => $vid){
                $i++;
                $output.='

                     <tr>
                      <td>'.$i.'</td>
                       <td>'.$vid->name_areas.'</td>

                       <td>'.$vid->desc_areas.'</td>

                        <td>
                        <img src="'.asset('/uploads/category/'.$vid->image_areas).'" class="img-thumbnail" width="80" height="80">
         
                        </td>

                       
                       <td><button type="button" data-id_areas="'.$vid->id_areas.'"  class="btn btn-xs btn-danger btn-delete-areas">Xóa</button></td>
                     </tr>                                   
                ';
            }
        }else{ 
            $output.='
                          <tr>
                             <td colspan="4">Chưa có danh muc nào hết</td>
                                       
                               </tr>

                ';

        }
        $output.='
                 </tbody>
                </table>
            </form>


                ';
        echo $output;
      }




    public function delete_areas(Request $request){
        $data = $request->all();
        $id_areas = $data['id_areas'];

        $areas = tb_business_areas::find($id_areas);
        
        if($areas->image_areas != "fieldpng.png"){
            unlink('/uploads/category/'.$areas->image_areas);
        }


        $areas->delete();
    }





       
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_statistical_order;
use Carbon\Carbon;
use Session;
class statisticalController extends Controller
{
 

 public function days_order(){
    $id_store = Session::get('id_store');
    $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $get = tb_statistical_order::where('id_store', $id_store)->whereBetween('order_date',[$sub60days,$now])->orderBy('order_date','ASC')->get();

       if($get->count() >0){
         foreach($get as $key => $val){

                $chart_data[] = array(
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales."000",
                    'profit' => $val->profit."000",
                    'quantity' => $val->quantity
                );
            }

    echo $data = json_encode($chart_data);
    }else{
     $chart_data[] =null;
     echo $data = json_encode($chart_data);
    }
}

public function dashboard_filter(Request $request){

    $data = $request->all();


    $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
    $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();


    $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

    $dauthang9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->startOfMonth()->toDateString();
    $cuoithang9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->endOfMonth()->toDateString();

  
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    if($data['dashboard_value']=='7ngay'){

        $get = tb_statistical_order::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();

    }elseif($data['dashboard_value']=='thangtruoc'){

        $get = tb_statistical_order::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();

    }elseif($data['dashboard_value']=='thangnay'){

        $get = tb_statistical_order::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();

    }else{
        $get = tb_statistical_order::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
    }

    
    if($get->count() >0){
         foreach($get as $key => $val){

                $chart_data[] = array(
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales."000",
                    'profit' => $val->profit."000",
                    'quantity' => $val->quantity
                );
            }

    echo $data = json_encode($chart_data);
    }else{
     $chart_data[] =null;
     echo $data = json_encode($chart_data);
    }
   

}
public function filter_by_date(Request $request){

    $data = $request->all();

    $from_date = $data['from_date'];
    $to_date = $data['to_date'];

    $get = tb_statistical_order::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();

    if($get->count() >0){
         foreach($get as $key => $val){

                $chart_data[] = array(
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales."000",
                    'profit' => $val->profit."000",
                    'quantity' => $val->quantity
                );
            }

    echo $data = json_encode($chart_data);
    }else{
     $chart_data[] =null;
     echo $data = json_encode($chart_data);
    }  

}


}

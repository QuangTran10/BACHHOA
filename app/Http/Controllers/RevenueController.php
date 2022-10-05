<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
use Auth;
session_start();

class RevenueController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function show_statistical(){
        $this->AuthLogin();
    	Session::put('page',9);
    	return view('admin.Statistic.show_statistic');
    }

    public function load_statistic(){
    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$first_day=Carbon::create(Carbon::now()->year, 1, 1);

    	$revenue = DB::table('dathang')
    	->whereBetween('NgayDat', [ $first_day, $now])
    	->select(DB::raw('COUNT(MSDH) as soluong, MONTH(NgayDat) as Thang'))->groupBy('Thang')
    	->get();

    	$labels=array();
    	$series=array();
    	foreach ($revenue as $key => $value) {
    		$labels[]='Tháng '.$value->Thang;
    		$series[]=$value->soluong;
    	}
    	$chart_data = array(
    		'labels' => $labels,
    		'series' => $series
    	);

    	echo $data = json_encode($chart_data);
    }

    public function search_statistic(Request $re){
    	$start_date=$re->start_date;
    	$end_date= $re->end_date;

    	$revenue = DB::table('dathang')
    	->whereBetween('NgayDat', [ $start_date, $end_date])
    	->select(DB::raw('COUNT(MSDH) as soluong, DAY(NgayDat) as Ngay, DATE(NgayDat) as Date'))->groupBy('Ngay','Date')
        ->orderBy('Date','asc')->get();

    	$labels=array();
    	$series=array();
    	foreach ($revenue as $key => $value) {
    		$date = date('d-m-Y', strtotime($value->Date));
    		$labels[]=$date;
    		$series[]=$value->soluong;
    	}
    	$chart_data = array(
    		'labels' => $labels,
    		'series' => $series
    	);

    	echo $data = json_encode($chart_data);
    }
}

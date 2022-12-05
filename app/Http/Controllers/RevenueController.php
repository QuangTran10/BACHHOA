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

        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $first_day=Carbon::create(Carbon::now()->year, 1, 1);

        $revenue = DB::table('dathang')
        ->whereBetween('NgayDat', [ $first_day, $now])->where('TrangThai',4)
        ->select(DB::raw('COUNT(MSDH) as soluong, SUM(ThanhTien) as doanhthu, MONTH(NgayDat) as Thang'))
        ->groupBy('Thang')->get();

        $receipt = DB::table('phieunhap')
        ->whereBetween('NgayLap', [ $first_day, $now])
        ->select(DB::raw('SUM(ThanhTien) as tongnhap, MONTH(NgayLap) as Thang'))
        ->groupBy('Thang')->get();

        $labels=array();
        $series1=array();
        $series2=array();
        $series3=array();

        foreach ($revenue as $key => $value) {
            $labels[]='Tháng '.$value->Thang;
            $series1[]=$value->soluong;
            $series2[]=$value->doanhthu;
        }

        foreach ($receipt as $key => $value) {
            $series3[]=$value->tongnhap;
        }

    	return view('admin.Statistic.show_statistic', compact('labels','series1','series2','series3'));
    }

    public function customer_statistic(Request $request){
        $this->AuthLogin();
        Session::put('page',13);

        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $first_day=Carbon::create(Carbon::now()->year, 1, 1);

        $revenue = DB::table('dathang')
        ->join('khachhang', 'dathang.MSKH', '=', 'khachhang.MSKH')
        ->whereBetween('NgayDat', [ $first_day, $now])->where('dathang.TrangThai',4)
        ->select(DB::raw('COUNT(dathang.MSKH) as soluong, SUM(ThanhTien) as doanhthu, dathang.MSKH, HoTenKH'))
        ->groupBy('dathang.MSKH', 'HoTenKH')->orderBy('soluong','DESC')->get();

        $labels=array();
        $series1=array();
        $series2=array();

        foreach ($revenue as $key => $value) {
            $labels[]=$value->HoTenKH;
            $series1[]=$value->soluong;
            $series2[]=$value->doanhthu;
        }

        return view('admin.Statistic.customer_statistic', compact('labels', 'series1', 'series2'));
    }

    public function load_statistic(){
    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$first_day=Carbon::create(Carbon::now()->year, 1, 1);

    	$revenue = DB::table('dathang')
    	->whereBetween('NgayDat', [ $first_day, $now])->where('TrangThai',4)
    	->select(DB::raw('COUNT(MSDH) as soluong, SUM(ThanhTien) as doanhthu, MONTH(NgayDat) as Thang'))
        ->groupBy('Thang')->get();

        $receipt = DB::table('phieunhap')
        ->whereBetween('NgayLap', [ $first_day, $now])
        ->select(DB::raw('SUM(ThanhTien) as tongnhap, MONTH(NgayLap) as Thang'))
        ->groupBy('Thang')->get();

    	$labels=array();
    	$series1=array();
        $series2=array();
        $series3=array();

    	foreach ($revenue as $key => $value) {
    		$labels[]='Tháng '.$value->Thang;
    		$series1[]=$value->soluong;
            $series2[]=$value->doanhthu;
    	}

        foreach ($receipt as $key => $value) {
            $series3[]=$value->tongnhap;
        }

    	$chart_data = array(
    		'labels'  => $labels,
    		'series1' => $series1,
            'series2' => $series2,
            'series3' => $series3,
    	);


    	echo $data = json_encode($chart_data);
    }

    public function search_statistic(Request $re){
    	$start_date=$re->start_date;
    	$end_date= $re->end_date;

    	$revenue = DB::table('dathang')
    	->whereBetween('NgayDat', [$start_date, $end_date])
    	->select(DB::raw('COUNT(MSDH) as soluong, SUM(ThanhTien) as doanhthu, DAY(NgayDat) as Ngay, DATE(NgayDat) as Date'))
        ->groupBy('Ngay','Date')->orderBy('Date','asc')->get();


    	$labels=array();
    	$series1=array();
        $series2=array();
        $series3=array();

    	foreach ($revenue as $key => $value) {
    		$date = date('d-m-Y', strtotime($value->Date));
    		$labels[]=$date;
    		$series1[]=$value->soluong;
            $series2[]=$value->doanhthu;
    	}

        $chart_data = array(
            'labels'  => $labels,
            'series1' => $series1,
            'series2' => $series2,
        );

    	echo $data = json_encode($chart_data);
    }

    public function quantity_statistic(){
        $this->AuthLogin();
        Session::put('page',12);
        $receipt = DB::table('chitietphieunhap')
        ->join('sanpham', 'chitietphieunhap.MSSP', '=', 'sanpham.MSSP')
        ->select('chitietphieunhap.MSSP','TenSP',DB::raw('SUM(SoLuongNhap) as soluongnhap'))
        ->groupBy('chitietphieunhap.MSSP','TenSP')->distinct()
        ->get();

        $receipts = array();

        foreach ($receipt as $key => $value) {
            $product = DB::table('sanpham')->where('MSSP', $value->MSSP)->first();

            $receipts[] = array(
                'MSSP'  => $value->MSSP,
                'TenSP' => $value->TenSP,
                'SoLuongNhap' => $value->soluongnhap,
                'SoLuongTon' => $product->SoLuong,
            );
        }

        return view('admin.Statistic.quantity_statistic', compact('receipts'));
    }


    public function precious_statistic(Request $request){
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $start;
        $end;

        $type = $request->type;
        if($type!=5){
            if($type==1){
                $start = new Carbon('first day of January');
                $end  = new Carbon('last day of March');
            }elseif($type==2){
                $start = new Carbon('first day of April');
                $end  = new Carbon('last day of June');
            }elseif($type==3){
                $start = new Carbon('first day of July');
                $end  = new Carbon('last day of March');
            }elseif($type==4){
                $start = new Carbon('first day of September');
                $end  = new Carbon('last day of December');
            }
        }else{
            $start = new Carbon('first day of January');
            $end  = new Carbon('last day of December');
        }

        $revenue = DB::table('dathang')
        ->whereBetween('NgayDat', [ $start, $end])->where('TrangThai',4)
        ->select(DB::raw('COUNT(MSDH) as soluong, SUM(ThanhTien) as doanhthu, MONTH(NgayDat) as Thang'))
        ->groupBy('Thang')->get();

        $receipt = DB::table('phieunhap')
        ->whereBetween('NgayLap', [ $start, $end])
        ->select(DB::raw('SUM(ThanhTien) as tongnhap, MONTH(NgayLap) as Thang'))
        ->groupBy('Thang')->get();

        $labels=array();
        $series1=array();
        $series2=array();
        $series3=array();

        foreach ($revenue as $key => $value) {
            $labels[]='Tháng '.$value->Thang;
            $series1[]=$value->soluong;
            $series2[]=$value->doanhthu;
        }

        foreach ($receipt as $key => $value) {
            $series3[]=$value->tongnhap;
        }

        $chart_data = array(
            'labels'  => $labels,
            'series1' => $series1,
            'series2' => $series2,
            'series3' => $series3,
        );


        echo $data = json_encode($chart_data);
    }
}

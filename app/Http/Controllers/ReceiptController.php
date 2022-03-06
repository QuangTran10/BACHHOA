<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
session_start();

class ReceiptController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
	//Danh sách
	public function show_all(){
        $this->AuthLogin();
		$all= DB::table('phieuthu')->get();
		Session::put('page',7);
		return view('admin.Receipt.receipt_all')->with('all_receipt', $all);
	}

    //Thêm phiếu nhập
    public function show_add(){
        $this->AuthLogin();
    	$all_product = DB::table('hanghoa')->join('nhasanxuat', 'hanghoa.MaNSX', '=', 'nhasanxuat.MaNSX')
        ->where('MaPhieu',NULL)->get();

        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
    	return view('admin.Receipt.add_receipt')->with('all_product',$all_product)->with('all_producer',$all_producer);
    }

    //add
    public function add(Request $re){
        $this->AuthLogin();
    	$data= $re->all();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

    	//Receipt
    	$receipt=array();
    	$receipt['NguoiNP']=Session::get('full_name');
    	$receipt['ThanhTien']=0;
    	$receipt['NgayLap']=$now;
    	$receipt['NCC']=$re->NCC;
    	$receipt['GhiChu']=$re->GhiChu;
    	$receipt['TinhTrang']=1;
    	$receipt['TG_Tao']=$now;
    	$receipt['TG_CapNhat']=$now;
    	
    	$MaPhieu=DB::table('phieuthu')->insertGetId($receipt);

    	$ds= array();
    	$ThanhTien=0;
    	$kq=0;
    	foreach ($data['sp'] as $key => $value) {
    		$ds['MSHH']=$key;
    		$ds['MaPhieu']=$MaPhieu;
    		$product = DB::table('hanghoa')->where('MSHH',$key)->get();
    		foreach ($product as $k => $val) {
    			$ThanhTien=$ThanhTien + $val->SoLuongHang*$val->Gia;
    			$ds['SoLuong']=$val->SoLuongHang;
    			$ds['DonGia']=$val->Gia;
    			$ds['TG_Tao']=$now;
    			$ds['TG_CapNhat']=$now;
    		}
    		$result=DB::table('chitietphieuthu')->insert($ds);
    		DB::table('hanghoa')->where('MSHH', $val->MSHH)->update(['MaPhieu' =>$MaPhieu]);
    		if ($result) {
    			$kq=1;
    		}
    	}

    	if ($kq==1) {
    		DB::table('phieuthu')->where('MaPhieu', $MaPhieu)->update(['ThanhTien' => $ThanhTien]);
    		return Redirect::to('show_receipt');
    	}else{
    		Session::put('message','Thêm Thất bại');
        	return Redirect::to('add_receipt');
    	}

    }
}

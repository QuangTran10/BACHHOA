<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Collection;
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
		$all= DB::table('phieuthu')
        ->join('nhanvien', 'nhanvien.MSNV', '=', 'phieuthu.MSNV')->get();
		Session::put('page',7);
		return view('admin.Receipt.receipt_all')->with('all_receipt', $all);
	}

    //Thêm phiếu nhập
    public function show_add(){
        $this->AuthLogin();
        $all_receipt = DB::table('chitietphieuthu')->select("MSSP")->get()->toArray();

        $data = array();
        foreach ($all_receipt as $key => $value) {
            $data[]=$value->MSSP;
        }

        $all_product = DB::table('sanpham')->select("MSSP")->whereNotIn("MSSP",$data)->get();
        
        $product = array();
        foreach ($all_product as $key => $value) {
            $product[]=DB::table('sanpham')
            ->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
            ->where('MSSP',$value->MSSP)
            ->select('sanpham.*','danhmuc.TenDanhMuc')->first();
        }

    	return view('admin.Receipt.add_receipt')->with('all_product',$product);
    }

    //add
    public function add(Request $re){
        $this->AuthLogin();
    	$data= $re->all();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

    	//Receipt
    	$receipt=array();
    	$receipt['MSNV']=Session::get('admin_id');
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
    		$ds['MSSP']=$key;
    		$ds['MaPhieu']=$MaPhieu;
    		$product = DB::table('sanpham')->where('MSSP',$key)->get();
    		foreach ($product as $k => $val) {
    			$ThanhTien=$ThanhTien + $val->SoLuong*$val->Gia;
    			$ds['SoLuong']=$val->SoLuong;
    			$ds['DonGia']=$val->Gia;
    			$ds['TG_Tao']=$now;
    			$ds['TG_CapNhat']=$now;
    		}
    		$result=DB::table('chitietphieuthu')->insert($ds);
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

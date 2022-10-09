<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
use App\Models\Shipper;
session_start();

class ShipperController extends Controller
{
	public function AuthLogin(){
        $shipper_id = Session::get('shipper_id');
        if($shipper_id){
            
        }else{
            return Redirect::to('shipper')->send();
        }
    }

	public function index(){
		return view('shipper.shipper_login');
	}

	public function register(){
		$city = DB::table('tinhthanhpho')->get();

		return view('shipper.shipper_register', compact('city'));
	}

	//Trang Chủ
    public function dashboard(){
    	$this->AuthLogin();
    	return view('shipper.home');
    }

    //Trang Đơn hàng 
    public function order_process(){
    	$this->AuthLogin();

    	$order = DB::table('dathang')->get();

    	$order_details=DB::table('chitietdathang')
    		->join('sanpham', 'chitietdathang.MSSP', '=', 'sanpham.MSSP')->select('chitietdathang.*', 'TenSP')->get();

    	return view('shipper.order_process', compact('order', 'order_details'));
    }

    //Trang Thông tin cá nhân
    public function infor(){
    	$this->AuthLogin();
    	$id = Session::get('shipper_id');

    	$city = DB::table('tinhthanhpho')->get();

    	$shipper = Shipper::find($id);

    	return view('shipper.shipper_infor', compact('shipper','city'));
    }

    public function notification(){
    	$this->AuthLogin();

    	return view('shipper.shipper_notification');
    }

	public function add(Request $request){
		$data = $request->all();

		$shipper = new Shipper();

		$shipper->HoTenGH = $data['HoTenGH'];
		$shipper->GioiTinh = $data['GioiTinh'];
		$shipper->SDT = $data['SDT'];
		$shipper->DiaChi = $data['DiaChi'];
		$shipper->ThanhPho = $data['ThanhPho'];
		$shipper->Password = md5($data['Password']);
		$shipper->Email = $data['Email'];

		$shipper->save();

		return Redirect::to('/shipper');
	}

	public function login(Request $request){
		
		$shipper = Shipper::where('Email', $request->Email)->where('Password', md5($request->Password))->first();

		if($shipper){
			Session::put('shipper_name',$shipper->HoTenGH);
            Session::put('shipper_id',$shipper->MSGH);
			return Redirect::to('/dashboard_shipper');
		}else{
			return redirect('/shipper')->with('notice','Mật khẩu hoặc tài khoản không đúng');
		}
	}

    public function logout(){
    	Session::put('shipper_name',null);
        Session::put('shipper_id',null);

        return Redirect::to('/shipper');
    }

}

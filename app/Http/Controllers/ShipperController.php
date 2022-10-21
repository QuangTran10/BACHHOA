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
use App\Jobs\SendEmailNoti;
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

    public function sendEmail($MSDH){
        $order=DB::table('dathang')
        ->join('giaohang', 'dathang.MSGH', '=', 'giaohang.MSGH')
        ->where('dathang.MSDH',$MSDH)->select('dathang.*', 'HoTenGH')->first();

        $customer = DB::table('khachhang')->where('MSKH',$order->MSKH)->first();

        $users = $customer->Email;

        $message = [
           'name_shipper' => $order->HoTenGH,
           'name'         => $order->HoTen,
           'address'      => $order->DiaChi,
           'phone'        => $order->SDT,
           'total'        => $order->ThanhTien,
           'MSDH'         => $order->MSDH,
        ];
        //Email cho khách hàng là đã giao hàng thành công
        SendEmailNoti::dispatch($message, $users)->delay(5);
    }

	//Trang Chủ
    public function dashboard(){
    	$this->AuthLogin();
    	return view('shipper.home');
    }

    //Trang Đơn hàng 
    public function order_process(){
    	$this->AuthLogin();

        $city = Session::get('shipper_city');
        $shipper_id = Session::get('shipper_id');

    	$order = DB::table('dathang')->where('MaTP',$city)->where('MSGH',$shipper_id)->get();

        $order_id = array();
        foreach ($order as $key => $value) {
            $order_id[] = $value->MSDH;
        }

    	$order_details=DB::table('chitietdathang')
    		->join('sanpham', 'chitietdathang.MSSP', '=', 'sanpham.MSSP')->select('chitietdathang.*', 'TenSP','Image','Gia')->whereIn('MSDH',$order_id)->get();

    	return view('shipper.order_process', compact('order', 'order_details'));
    }

    public function update(Request $request){
        $MSDH = $request->MSDH;
        $status = $request->status;
        $result;

        if($status==2){
            //NVGH nhận dơn
            $result= DB::table('dathang')->where('MSDH',$MSDH)->update(['TrangThai'=> 2]);
        }elseif($status==1){
            //NVGH không nhận đơn
            $result= DB::table('dathang')->where('MSDH',$MSDH)->update(['TrangThai'=> 1,'MSGH' => null]);
        }elseif($status==3){
            //NVGH đã lấy hàng và đang giao hàng
            $result= DB::table('dathang')->where('MSDH',$MSDH)->update(['TrangThai'=> 3]);
        }elseif($status==4){
            $result = DB::table('dathang')
            ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
            ->where('dathang.MSDH', $MSDH)->update(['TrangThai'=> 4,'TT_TrangThai'=>1]);

            $this->sendEmail($MSDH);
        }
        
        if($result){
            echo 1;
        }else{
            echo 0;
        }

    }

    //Trang Thông tin cá nhân
    public function infor(){
    	$this->AuthLogin();
    	$id = Session::get('shipper_id');

    	$city = DB::table('tinhthanhpho')->get();

    	$shipper = Shipper::find($id);

    	return view('shipper.shipper_infor', compact('shipper','city'));
    }

    public function update_shipper(Request $request){
        $this->AuthLogin();
        $data = $request->all();

        $shipper = Shipper::find($data['MSGH']);

        $shipper->HoTenGH = $data['HoTenGH'];
        $shipper->GioiTinh = $data['GioiTinh'];
        $shipper->SDT = $data['SDT'];
        $shipper->DiaChi = $data['DiaChi'];
        $shipper->ThanhPho = $data['ThanhPho'];
        $shipper->Email = $data['Email'];

        $shipper->save();

        return Redirect::to('/shipper_infor');

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
            Session::put('shipper_city',$shipper->ThanhPho);
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

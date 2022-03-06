<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Carbon\Carbon;
use Session;
session_start();

class CheckOutController extends Controller
{
    public function check_out(Request $re){
    	$MSKH=Session::get('user_id');
    	$all_address_by_id=DB::table('diachikh')->where('MSKH',$MSKH)->get();
    	$all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        //Seo
        $meta_desc="Thanh Toán Đơn Hàng";
        $meta_keywords="CheckOut";
        $meta_tittle="BACHHOA.COM";
        $url=$re->url();
        // end seo

    	return view('User.CheckOut.check_out')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('all_address_by_id',$all_address_by_id)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_tittle',$meta_tittle)->with('url',$url);
    }

    public function save_check_out(Request $re){
    	$content = Session::get('cart');
    	$MSKH=Session::get('user_id');
    	//Lấy dữ liệu từ bảng diachikh
    	$MaDC=$re->DiaChi;
    	$address_info=DB::table('diachikh')->where('MaDC',$MaDC)->get();
    	foreach ($address_info as $key => $value) {
            $HoTen = $value->HoTen;
            $SDT   = $value->SDT;;
    		$DiaChi= $value->DiaChi;
    	}

    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$data=array();
        $order=array();

        //insert table dathang
    	$data['MSKH']=$MSKH;
    	$data['MSNV']=NULL;
    	$data['ThanhTien']=0;
    	$data['HoTen']=$HoTen;
    	$data['SDT']=$SDT;
    	$data['DiaChi']=$DiaChi;
    	$data['NgayDat']=$now;
    	$data['NgayGiao']=NULL;
    	$data['PhuongThuc']=$re->PhuongThuc;
    	$data['TrangThai'] = 0;
        $data['GhiChu']=$re->GhiChu;
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $total=0;
        
        
        if($re->check==0){
            $SoDonDH=DB::table('dathang')->insertGetId($data);
            //insert table chitietdathang
            foreach ($content as $v_content) {
                $order['MSDH']=$SoDonDH;
                $order['MSSP']=$v_content['product_id'];
                $order['SoLuong']=$v_content['product_qty'];
                $order['GiamGia']=$v_content['product_discount'];
                $order['GiaDatHang']=$v_content['product_price'];
                $order['ThanhTien']=($v_content['product_price']*$v_content['product_qty']*(1-$v_content['product_discount']));
                $total=$total+$v_content['product_price']*$v_content['product_qty']*(1-$v_content['product_discount']);
                $result=DB::table('chitietdathang')->insert($order);
            }   
            if($total<1000000){
                $total = $total +30000;
            }
            if ($result) {
                DB::table('dathang')->where('MSDH',$SoDonDH)->update(['ThanhTien' => $total]);
                Session::put('cart',null);
                return Redirect::to('/complete_check_out');
            }else{
                return redirect('/check_out')->with('notice','Thanh Toán Thất Bại');
            }
        }
    	
    }

    public function shipping_add(Request $request){
    	$MSKH=Session::get('user_id');
    	$data=array();
    	$data['HoTen']=$request->HoTen;
    	$data['SDT']=$request->SDT;
    	$data['DiaChi']=$request->DiaChi;
    	$data['MSKH']=$MSKH;
    	DB::table('diachikh')->insert($data);
    	return Redirect::to('/check_out');
    }

    public function complete_check_out(Request $re){
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        //Seo
        $meta_desc="Thanh Toán Đơn Hàng";
        $meta_keywords="CheckOut";
        $meta_tittle="BACHHOA.COM";
        $url=$re->url();
        // end seo

        return view('User.CheckOut.complete_check_out')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Carbon\Carbon;
use Session;
use App\Jobs\SendEmail;
session_start();

class CheckOutController extends Controller
{
    public function LoginCheck(){
        $MSKH=Session::get('user_id');
        if($MSKH){
            
        }else{
            return Redirect::to('login_home')->send();
        }
    }

    public function sendEmail($MSDH, $MaDC, $MSKH){
        $order=DB::table('dathang')->where('MSDH',$MSDH)->get();

        $order_details=DB::table('chitietdathang')
        ->join('sanpham', 'chitietdathang.MSSP', '=', 'sanpham.MSSP')
        ->where('MSDH',$MSDH)->select('chitietdathang.*', 'TenSP','Image')->get();

        $address_info=DB::table('diachikh')->where('MaDC',$MaDC)->get();
        foreach ($address_info as $key => $value) {
            $HoTen = $value->HoTen;
            $SDT   = $value->SDT;;
            $DiaChi= $value->DiaChi;
        }

        $customer = DB::table('khachhang')->where('MSKH',$MSKH)->first();

        $users = $customer->Email;
        $greeting = 'Xin chào '.$customer->HoTenKH.',';

        $title = 'Bee Store đã nhận được yêu cầu đặt hàng của bạn và đang xử lý nhé. Bạn sẽ nhận được thông báo tiếp theo khi đơn hàng đã sẵn sàng được giao.';

        $message = [
           'greeting'=> $greeting,
           'title'   => $title,
           'order' => $order,
           'order_details' => $order_details,
           'name' => $HoTen,
           'address'=> $DiaChi,
           'phone' => $SDT,
        ];
        SendEmail::dispatch($message, $users)->delay(5);
    }

    public function check_out(Request $re){
        $this->LoginCheck();
    	$MSKH=Session::get('user_id');
    	$all_address_by_id=DB::table('diachikh')->where('MSKH',$MSKH)->get();
    	$all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->where('TrangThai',1)->get();

        //Seo
        $meta_desc="Thanh Toán Đơn Hàng";
        $meta_keywords="CheckOut";
        $meta_tittle="BACHHOA.COM";
        $url=$re->url();
        // end seo

        $province = DB::table('tinhthanhpho')->get();

    	return view('User.CheckOut.check_out')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('all_address_by_id',$all_address_by_id)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('province', $province);
    }

    public function add_check_out(Request $re){
    	$content = Session::get('cart');
    	$MSKH=Session::get('user_id');
        $total=0;
        
    	//Lấy dữ liệu từ bảng diachikh
    	$MaDC=$re->DiaChi;
    	$address_info=DB::table('diachikh')->where('MaDC',$MaDC)->get();
    	foreach ($address_info as $key => $value) {
            $HoTen = $value->HoTen;
            $SDT   = $value->SDT;;
    		$DiaChi= $value->DiaChi;
            $MaTP  = $value->matp;
    	}

    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$data=array();
        $order=array();
        $payment = array();
        $coupon = array();
        
        //insert table thanhtoan
        $payment['TT_Ten'] = $re->PhuongThuc;
        $payment['TT_DienGiai']="Thanh toan don hang";
        $payment['TT_TrangThai']=0; // Có 2 trạng thái: Chưa TT và Đã Thanh Toán
        $payment['TT_BankCode']=null;
        $payment['TT_CodeVnpay']=null;
        $payment['TT_ResponseCode']=null;
        $payment['TT_TaoMoi'] = $now;
        $payment['TT_CapNhat'] = $now;

        $MaThanhToan = DB::table('thanhtoan')->insertGetId($payment);

        //insert table dathang
    	$data['MSKH']=$MSKH;
    	$data['MSNV']=NULL;
        $data['MSGH']=NULL;
    	$data['ThanhTien']=$re->ThanhTien;
    	$data['HoTen']=$HoTen;
    	$data['SDT']=$SDT;
    	$data['DiaChi']=$DiaChi;
        $data['MaTP'] = $MaTP;
    	$data['NgayDat']=$now;
    	$data['NgayGiao']=NULL;
        $data['MaThanhToan']=$MaThanhToan;
        $data['GhiChu']=$re->GhiChu;
        $data['TrangThai']=0;   // 4 trạng thái: chờ xn, đang vận chuyển, đã nhận và đã huỷ

        $SoDonDH = DB::table('dathang')->insertGetId($data);
            //insert table chitietdathang
        foreach ($content as $v_content) {
            $order['MSDH']=$SoDonDH;
            $order['MSSP']=$v_content['product_id'];
            $order['SoLuong']=$v_content['product_qty'];
            $order['GiamGia']=$v_content['product_discount'];
            $order['GiaDatHang']=$v_content['product_price'];
            $order['ThanhTien']=($v_content['product_price']*$v_content['product_qty']*(1-$v_content['product_discount']));
            $result=DB::table('chitietdathang')->insert($order);
            //Kiểm tra sau khi thêm sản phẩm vào chitietdathang nếu soluong còn lại bằng 0 thì cập nhật tình trạng bằng 0
            $kq = DB::table('sanpham')->where('MSSP',$v_content['product_id'])->select('SoLuong')->get();
            foreach ($kq as $val) {
                $qty_ton=$val->SoLuong;
            }
            if($qty_ton==0){
                DB::table('sanpham')->where('MSSP',$v_content['product_id'])->update(['TrangThai'=>0]);
            }
        }

        //Nếu tồn tại mã giảm giá thì insert vào DB
        if($re->session()->exists('coupon_id')){
            $coupon_id = Session::get('coupon_id');

            $coupon['MSKH']= $MSKH;
            $coupon['MaGG']= $coupon_id;
            $coupon['MSDH']= $SoDonDH;

            DB::table('sudungma')->insert($coupon);
            //Loại bỏ mã giảm giá ra khỏi session
            Session::forget(['coupon_id', 'coupon_type', 'coupon_price', 'coupon_code']);
        }

        if ($result) {
            Session::put('cart',null);
            $this->sendEmail($SoDonDH, $MaDC, $MSKH);
            return Redirect::to('/complete_check_out');
        }else{
            return redirect('/check_out')->with('notice','Thanh Toán Thất Bại');
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
        $loaihang = DB::table('loaihang')->where('TrangThai',1)->get();

        //Seo
        $meta_desc="Thanh Toán Đơn Hàng";
        $meta_keywords="Complete Check Out";
        $url=$re->url();

        // end seo

        return view('User.CheckOut.complete_check_out')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('url',$url);
    }

    public function vnpay_check_out(Request $re){
        $this->LoginCheck();
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->where('TrangThai',1)->get();
        $MSKH=Session::get('user_id');
        $all_address_by_id=DB::table('diachikh')->where('MSKH',$MSKH)->get();

        //Seo
        $meta_desc="Thanh Toán Đơn Hàng";
        $meta_keywords="CheckOut";
        $url=$re->url();
        // end seo

        return view('User.CheckOut.vnpay_checkout')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('url',$url)->with('all_address_by_id',$all_address_by_id);
    }

    public function momo_check_out(Request $re){
        $this->LoginCheck();
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();
        $MSKH=Session::get('user_id');
        $all_address_by_id=DB::table('diachikh')->where('MSKH',$MSKH)->get();

        //Seo
        $meta_desc="Thanh Toán Đơn Hàng";
        $meta_keywords="CheckOut";
        $url=$re->url();
        // end seo

        return view('User.CheckOut.momo_checkout')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('url',$url)->with('all_address_by_id',$all_address_by_id);
    }
}

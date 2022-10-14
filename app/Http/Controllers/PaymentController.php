<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
session_start();

class PaymentController extends Controller
{
    public function vnpay_payment(Request $re){
    	$data = $re->all();
    	$code = rand(0,5000);
    	Session::put('Addr',$data['DiaChi']);
		Session::put('Note',$data['GhiChu']);

    	$vnp_TmnCode = "C1RLUOKT"; //Website ID in VNPAY System
		$vnp_HashSecret = "TMSVMMRAGULGSBLJKXJXPVBQKBAHLYKQ"; //Secret key
		$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
		$vnp_Returnurl = "http://localhost/WebBanThuoc/vnpay_return";
		$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";

		$vnp_TxnRef = $code; //Mã đơn hàng. 
		$vnp_OrderInfo = "Thanh toan don hang";
		$vnp_OrderType = "billpayment";
		$vnp_Amount = $data['Total'] * 100;
		$vnp_Locale = "vn";
		$vnp_BankCode = "NCB";
		$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
		//Add Params of 2.0.1 Version
		// $vnp_ExpireDate = $_POST['txtexpire'];
		
		$inputData = array(
		    "vnp_Version" => "2.1.0",
		    "vnp_TmnCode" => $vnp_TmnCode,
		    "vnp_Amount" => $vnp_Amount,
		    "vnp_Command" => "pay",
		    "vnp_CreateDate" => date('YmdHis'),
		    "vnp_CurrCode" => "VND",
		    "vnp_IpAddr" => $vnp_IpAddr,
		    "vnp_Locale" => $vnp_Locale,
		    "vnp_OrderInfo" => $vnp_OrderInfo,
		    "vnp_OrderType" => $vnp_OrderType,
		    "vnp_ReturnUrl" => $vnp_Returnurl,
		    "vnp_TxnRef" => $vnp_TxnRef
		);

		if (isset($vnp_BankCode) && $vnp_BankCode != "") {
		    $inputData['vnp_BankCode'] = $vnp_BankCode;
		}
		if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
		    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
		}

		//var_dump($inputData);
		ksort($inputData);
		$query = "";
		$i = 0;
		$hashdata = "";
		foreach ($inputData as $key => $value) {
		    if ($i == 1) {
		        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
		    } else {
		        $hashdata .= urlencode($key) . "=" . urlencode($value);
		        $i = 1;
		    }
		    $query .= urlencode($key) . "=" . urlencode($value) . '&';
		}

		$vnp_Url = $vnp_Url . "?" . $query;
		if (isset($vnp_HashSecret)) {
		    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
		    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
		}
		$returnData = array('code' => '00'
		    , 'message' => 'success'
		    , 'data' => $vnp_Url);

		return Redirect::to($vnp_Url);

    }

    public function vnpay_return(Request $re){
    	$MaDC = Session::get('Addr');
    	$Note = Session::get('Note');
    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$content = Session::get('cart');
    	$MSKH=Session::get('user_id');

    	$payment = array();
		$data=array();
		$order=array();
        if ($_GET['vnp_ResponseCode'] == '00') {
            //Lấy dữ liệu từ link
            $TT_Bankcode = $_GET['vnp_BankCode'];
            $TT_CodeVnpay= $_GET['vnp_BankTranNo'];
            $TT_Response = $_GET['vnp_TransactionStatus'];
            $Note = $_GET['vnp_OrderInfo'];
            $Amount = $_GET['vnp_Amount'] /100;
            
            //insert table thanhtoan
            $payment['TT_Ten'] = "Thanh Toán Bằng VnPay";
            $payment['TT_DienGiai']=$Note;
            $payment['TT_TrangThai']=1; // Có 2 trạng thái: Chưa TT và Đã Thanh Toán
            $payment['TT_BankCode']=$TT_Bankcode;
            $payment['TT_Code']=$TT_CodeVnpay;
            $payment['TT_ResponseCode']=$TT_Response;
            $payment['created_at'] = $now;
            $payment['updated_at'] = $now;
            $MaThanhToan = DB::table('thanhtoan')->insertGetId($payment);

            
            //Lấy dữ liệu từ bảng diachikh
            
            $address_info=DB::table('diachikh')->where('MaDC',$MaDC)->get();
            foreach ($address_info as $key => $value) {
                $HoTen = $value->HoTen;
                $SDT   = $value->SDT;;
                $DiaChi= $value->DiaChi;
            }

            //insert table dathang
            $data['MSKH']=$MSKH;
            $data['MSNV']=NULL;
            $data['ThanhTien']=$Amount;
            $data['HoTen']=$HoTen;
            $data['SDT']=$SDT;
            $data['DiaChi']=$DiaChi;
            $data['NgayDat']=$now;
            $data['NgayGiao']=NULL;
            $data['MaThanhToan']=$MaThanhToan;
            $data['GhiChu']=$re->GhiChu;
            $data['TrangThai']=0;   // 4 trạng thái: chờ xn, đang vận chuyển, đã nhận và đã huỷ
            $data['created_at'] = $now;
            $data['updated_at'] = $now;
            
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
                    $result=DB::table('chitietdathang')->insert($order);

                    $kq = DB::table('sanpham')->where('MSSP',$v_content['product_id'])->select('SoLuong')->get();
                    foreach ($kq as $val) {
                        $qty_ton=$val->SoLuong;
                    }
                    if($qty_ton==0){
                        DB::table('sanpham')->where('MSSP',$v_content['product_id'])->update(['TrangThai'=>0]);
                    }
                }   
                if ($result) {
                    Session::put('cart',null);
                    Session::put('Addr', null);
                    Session::put('Note',null);
                    return Redirect::to('/complete_check_out');
                }else{
                    return redirect('/vnpay_check_out')->with('notice','Thanh Toán Thất Bại');
                }
            }
        }else{
            return Redirect::to('/error_payment');
        }    
    }

}

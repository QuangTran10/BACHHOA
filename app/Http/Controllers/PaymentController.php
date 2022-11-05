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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    	$data = $re->all();
    	$code = rand(0,50000);
        $MSKH=Session::get('user_id');
    	Session::put('Addr',$data['DiaChi']);
		Session::put('Note',$data['GhiChu']);

        // print_r($data);

        $address=DB::table('diachikh')->join('tinhthanhpho', 'tinhthanhpho.matp','=','diachikh.matp')
        ->where('MaDC',$data['DiaChi'])->first();
        $user = DB::table('khachhang')->where('MSKH', $MSKH)->first();

    	$vnp_TmnCode = "C1RLUOKT"; //Website ID in VNPAY System
		$vnp_HashSecret = "TMSVMMRAGULGSBLJKXJXPVBQKBAHLYKQ"; //Secret key
		$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
		$vnp_Returnurl = "http://localhost/BachHoa/vnpay_return";
		$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";

        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+30 minutes',strtotime($startTime)));

        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toan don hang";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $data['Total'] * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = request()->ip();
        //Add Params of 2.0.1 Version
        $vnp_ExpireDate = $expire;
        //echo $vnp_ExpireDate;
        // //Billing
        $vnp_Bill_Mobile = $address->SDT;
        $vnp_Bill_Email = $user->Email;
        $fullName = trim($address->HoTen);
        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }
        $vnp_Bill_Address=$address->DiaChi;
        $vnp_Bill_City=$address->name;
        $vnp_Bill_Country="VN";
        $vnp_Bill_State="";
        // Invoice
        $vnp_Inv_Phone= $address->HoTen;
        $vnp_Inv_Email= $user->Email;
        $vnp_Inv_Customer=$user->HoTenKH;
        $vnp_Inv_Address=$address->DiaChi;
        $vnp_Inv_Company="BEE STORE";
        $vnp_Inv_Taxcode="0102182292";
        $vnp_Inv_Type="I";
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
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$vnp_ExpireDate,
            "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            "vnp_Bill_Email"=>$vnp_Bill_Email,
            "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            "vnp_Bill_Address"=>$vnp_Bill_Address,
            "vnp_Bill_City"=>$vnp_Bill_City,
            "vnp_Bill_Country"=>$vnp_Bill_Country,
            "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            "vnp_Inv_Email"=>$vnp_Inv_Email,
            "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            "vnp_Inv_Address"=>$vnp_Inv_Address,
            "vnp_Inv_Company"=>$vnp_Inv_Company,
            "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            "vnp_Inv_Type"=>$vnp_Inv_Type
        );

        


        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
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
        return redirect($vnp_Url);

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
            $payment['TT_CodeVnpay']=$TT_CodeVnpay;
            $payment['TT_ResponseCode']=$TT_Response;
            $payment['TT_TaoMoi'] = $now;
            $payment['TT_CapNhat'] = $now;
            $MaThanhToan = DB::table('thanhtoan')->insertGetId($payment);

            
            //Lấy dữ liệu từ bảng diachikh
            
            $address_info=DB::table('diachikh')->where('MaDC',$MaDC)->get();
            foreach ($address_info as $key => $value) {
                $HoTen = $value->HoTen;
                $SDT   = $value->SDT;;
                $DiaChi= $value->DiaChi;
                $MaTP  = $value->matp;
            }

            //insert table dathang
            $data['MSKH']=$MSKH;
            $data['MSNV']=NULL;
            $data['MSGH']=NULL;
            $data['ThanhTien']=$Amount;
            $data['HoTen']=$HoTen;
            $data['SDT']=$SDT;
            $data['DiaChi']=$DiaChi;
            $data['MaTP'] = $MaTP;
            $data['NgayDat']=$now;
            $data['NgayGiao']=NULL;
            $data['MaThanhToan']=$MaThanhToan;
            $data['GhiChu']=$re->GhiChu;
            $data['TrangThai']=0;   // 4 trạng thái: chờ xn, đang vận chuyển, đã nhận và đã huỷ
            
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

            //Nếu tồn tại mã giảm giá thì insert vào DB
            if($re->session()->exists('coupon_id')){
                $coupon_id = Session::get('coupon_id');

                $coupon['MSKH']= $MSKH;
                $coupon['MaGG']= $coupon_id;
                $coupon['MSDH']= $SoDonDH;

                DB::table('sudungma')->insert($coupon);
                //Loại bỏ mã giảm giá ra khỏi session
                Session::forget(['coupon_id', 'coupon_type', 'coupon_price']);
            }   

            if ($result) {
                Session::put('cart',null);
                Session::put('Addr', null);
                Session::put('Note',null);
                return Redirect::to('/complete_check_out');
            }else{
                return redirect('/vnpay_check_out')->with('notice','Thanh Toán Thất Bại');
            }
        }else{
            return Redirect::to('/error_payment');
        }    
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
use PDF;
session_start();

class OrderManagement extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function LoginCheck(){
        $MSKH=Session::get('user_id');
        if($MSKH){
            
        }else{
            return Redirect::to('login_home')->send();
        }
    }

    public function order_management(){
        $this->AuthLogin();
    	$all_order=DB::table('dathang')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->orderBy('dathang.MSDH','desc')->select('dathang.*', 'thanhtoan.TT_TrangThai')->get();

        $count = DB::table('dathang')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('dathang.TrangThai',0)
        ->get()->count();

    	Session::put('page',5);
    	return view('admin.Order.order_management')->with('all_order',$all_order)->with('count_order_process',$count);
    }

    public function count_order(){
        $data = array();
        $count = DB::table('dathang')
        ->where('TrangThai',0)->get()->count();

        $all_order=DB::table('dathang')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('TrangThai',0)->orderBy('MSDH','desc')->get();

        $data['count']=$count;
        $data['contend']='';
        if ($count!=0) {
            foreach ($all_order as $key => $value) {
                $content=$value->MSDH.' - '.$value->HoTen.'    '.$value->NgayDat;
                $url='/view_order/'.$value->MSDH;
                $data['contend'].='<a class="dropdown-item" href=" '.url($url).'">'.$content.'</a>';
            }
        }else{
            $data['contend'].='<a class="dropdown-item" >Kh??ng c?? th??ng b??o n??o </a>';
        }
        
        echo json_encode($data);
    }

    public function view_order($SoDonDH){
        $this->AuthLogin();
    	$order_by_id=DB::table('dathang')
    	->join('khachhang', 'dathang.MSKH', '=', 'khachhang.MSKH')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('dathang.MSDH',$SoDonDH)
        ->select('khachhang.MSKH', 'HoTenKH','GioiTinh','NgaySinh','khachhang.SDT','Email', 'dathang.*', 'thanhtoan.TT_TrangThai', 'thanhtoan.TT_Ten')->get();

    	$order_details=DB::table('chitietdathang')->join('sanpham', 'chitietdathang.MSSP', '=', 'sanpham.MSSP')->where('MSDH',$SoDonDH)->select('chitietdathang.*', 'TenSP')->get();

        $staff = DB::table('dathang')
        ->join('nhanvien', 'dathang.MSNV', '=', 'nhanvien.MSNV')
        ->where('dathang.MSDH',$SoDonDH)->first();
        $name_staff;
        if ($staff!=NULL) {
            $name_staff=$staff->HoTenNV;
        }else{
            $name_staff="Ch??a X??c Nh???n";
        }

    	return view('admin.Order.view_order')
        ->with('order_by_id',$order_by_id)->with('order_details',$order_details)
        ->with('MSDH',$SoDonDH)->with("NameStaff", $name_staff);
    }

    //X??c nh???n ????n h??ng. Ko c???p nh???t TT_TinhTrang
    public function update_status(Request $request){
    	$SoDonDH=$request->SoDonDH;
        $MSNV=Session::get('admin_id');
        $result=DB::table('dathang')
        ->where('MSDH',$SoDonDH)->update(['TrangThai'=> 1, 'MSNV'=>$MSNV]);
        if($result){
           return Redirect::to('/order_management');
        }else{
           return redirect('/view_order/'.$SoDonDH)->with('notice','C???p nh???t Kh??ng th??nh c??ng');
        }
    }
    public function print_order($checkout_code){
        $this->AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data=array();
        $contact = DB::table('lienhe')->get();

        $order_by_id=DB::table('dathang')
        ->join('khachhang', 'dathang.MSKH', '=', 'khachhang.MSKH')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('dathang.MSDH',$checkout_code)
        ->select('dathang.*', 'thanhtoan.TT_TrangThai', 'thanhtoan.TT_Ten')->get();

        $order_details=DB::table('chitietdathang')
        ->join('sanpham', 'chitietdathang.MSSP', '=', 'sanpham.MSSP')
        ->where('MSDH',$checkout_code)
        ->select('chitietdathang.*', 'TenSP')->get();

        $data['URL']='public/frontend/assets/images/logo.png';
        $data['order']=$order_by_id;
        $data['order_details']=$order_details;
        $data['contact']=$contact;

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.Order.invoice', $data);
        $name="Invoice_".$checkout_code."_".$now->day.$now->month.$now->year.".pdf";
        return $pdf->stream($name);
    }

    //USER

    public function show_order(Request $re){
        $this->LoginCheck();
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        $MSKH=Session::get('user_id');
        //C??c ????n h??ng ch??a x??? l??
        $orders_process = DB::table('dathang')->where('MSKH',$MSKH)->where('TrangThai',0)
        ->orderBy('MSDH','desc')->get();
        //C??c ????n h??ng ??ang giao h??ng
        $orders_shipping = DB::table('dathang')->where('MSKH',$MSKH)->where('TrangThai',1)->get();
        //C??c ????n h??ng ???? nh???n h??ng
        $orders_delivered = DB::table('dathang')->where('MSKH',$MSKH)->where('TrangThai',2)->get();
        //C??c ????n h??ng ???? hu???
        $orders_cancel = DB::table('dathang')->where('MSKH',$MSKH)->where('TrangThai',3)->get();

        $meta_desc="Th??ng Tin ????n H??ng";
        $meta_keywords="Show Order";
        $meta_tittle="QPharmacy";
        $url=$re->url();

        return view('User.Order.order')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('orders_process',$orders_process)->with('orders_shipping',$orders_shipping)
        ->with('orders_delivered',$orders_delivered)->with('orders_cancel',$orders_cancel);
    }
    public function order_detail($id_order, Request $re){
        $this->LoginCheck();
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        $order_de = DB::table('chitietdathang')
        ->join('sanpham', 'sanpham.MSSP', '=', 'chitietdathang.MSSP')
        ->where('chitietdathang.MSDH',$id_order)
        ->select('chitietdathang.*', 'sanpham.Image', 'sanpham.TenSP')->get();

        $order= DB::table('dathang')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('dathang.MSDH',$id_order)->first();

        $meta_desc="Chi Ti???t ????n H??ng";
        $meta_keywords="Show Order Details - ".$id_order;
        $meta_tittle="QPharmacy";
        $url=$re->url();

        return view('User.Order.order_detail')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('order_details',$order_de)->with('order',$order);
    }
    public function update_order(Request $re){
        $status = $re->TinhTrang;
        $TT_status = $re->TT_TrangThai;
        $MSDH= $re->MSDH;
        $result = DB::table('dathang')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('MSDH',$MSDH)->update(['TT_TrangThai' => $TT_status, 'TrangThai' => $status]);

        if ($status==3) {
            DB::table("chitietdathang")->where('MSDH',$MSDH)->delete();
        }
        if($result){
            return Redirect::to('/show_order');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
use Auth;
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

        //đếm các order cần xác nhận
        $count_order_process = DB::table('dathang')->where('dathang.TrangThai',0)->get()->count();

        //đếm các order cần chọn nhân viên vận chuyển
        $count_order_ship = DB::table('dathang')->where('TrangThai',1)->where('MSGH', null)->get()->count();

    	Session::put('page',5);
    	return view('admin.Order.order_management',compact('all_order', 'count_order_process','count_order_ship'));
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
            $data['contend'].='<a class="dropdown-item" >Không có thông báo nào </a>';
        }
        
        echo json_encode($data);
    }

    public function view_order($SoDonDH){
        $this->AuthLogin();

    	$order_by_id=DB::table('dathang')
    	->join('khachhang', 'dathang.MSKH', '=', 'khachhang.MSKH')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('dathang.MSDH',$SoDonDH)
        ->select('khachhang.MSKH', 'HoTenKH','GioiTinh','NgaySinh','khachhang.SDT','Email', 'dathang.*', 'thanhtoan.TT_TrangThai', 'thanhtoan.TT_Ten','MaTP','thanhtoan.TT_DienGiai')->first();

    	$order_details=DB::table('chitietdathang')->join('sanpham', 'chitietdathang.MSSP', '=', 'sanpham.MSSP')->where('MSDH',$SoDonDH)->select('chitietdathang.*', 'TenSP')->get();

        $staff = DB::table('dathang')
        ->join('nhanvien', 'dathang.MSNV', '=', 'nhanvien.MSNV')
        ->where('dathang.MSDH',$SoDonDH)->first();

        $shipper = DB::table('giaohang')->where('ThanhPho',$order_by_id->MaTP)->get();

        $name_staff;
        if ($staff!=NULL) {
            $name_staff=$staff->HoTenNV;
        }else{
            $name_staff="Chưa Xác Nhận";
        }

    	return view('admin.Order.view_order')
        ->with('order_by_id',$order_by_id)->with('order_details',$order_details)
        ->with('MSDH',$SoDonDH)->with("NameStaff", $name_staff)->with('shipper',$shipper);
    }

    public function choose_shipper(Request $request){
        $MSDH=$request->MSDH;
        $MSGH=$request->MSGH;

        $result = DB::table('dathang')->where('MSDH',$MSDH)->update(['TrangThai'=> 1, 'MSGH'=>$MSGH]);

        if($result){
           echo 1; //Chọn shipper thành công
        }else{
           echo 0; //Chọn không thành công
        }
    }

    //Xác nhận đơn hàng. Ko cập nhật TT_TinhTrang
    public function update_status(Request $request){
    	$SoDonDH=$request->SoDonDH;
        $MSNV=Session::get('admin_id');
        $result=DB::table('dathang')
        ->where('MSDH',$SoDonDH)->update(['TrangThai'=> 1, 'MSNV'=>$MSNV]);
        if($result){
           return Redirect::to('/order_management');
        }else{
           return redirect('/view_order/'.$SoDonDH)->with('notice','Cập nhật Không thành công');
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

        $data['URL']='public/frontend/assets/images/bee.png';
        $data['order']=$order_by_id;
        $data['order_details']=$order_details;
        $data['contact']=$contact;

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.Order.invoice', $data);
        $name="Invoice_".$checkout_code."_".$now->day.$now->month.$now->year.".pdf";
        return $pdf->stream($name);
    }

    public function find_order(Request $request){
        $data = $request->all();
        $output='';

        $order = DB::table('dathang')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('MSDH','like','%'.$data['text'].'%')
        ->orWhere('HoTen','like','%'.$data['text'].'%')
        ->orWhere('SDT','like','%'.$data['text'].'%')->orderBy('MSDH','desc')->get();


        $output.= '<table class="table table-hover">
            <thead class="text-warning">
              <th width="10%">Mã Đơn Hàng</th>
              <th width="15%">Tên Khách Hàng</th>
              <th width="10%">SDT</th>
              <th width="20%">Địa Chỉ</th>
              <th width="20%">Ngày Đặt Hàng</th>
              <th width="10%">Trạng Thái</th>
              <th style="text-align: center;" width="10%">Thanh Toán</th>
              <th width="5%"></th>
            </thead>
            <tbody>';
        foreach ($order as $key => $value) {
            $output.='<tr';
                if($value->TrangThai ==0)
                    $output.=' class="table-danger" ';

                $output.='> 
                <td>'.$value->MSDH.'</td>
                <td>'.$value->HoTen.'</td>
                <td>'.$value->SDT.'</td>
                <td>'.$value->DiaChi.'</td>
                <td>'.$value->NgayDat.'</td>
                <td>';

                if($value->TrangThai ==0){
                      $output.= 'Đang Xử Lý</td>';
                    }elseif($value->TrangThai == 1){
                      $output.='Chờ Lấy Hàng</td>';
                    }elseif($value->TrangThai ==2){
                      $output.= 'Nhận Đơn</td>';
                    }elseif($value->TrangThai ==3){
                      $output.= 'Đang Giao Hàng</td>';
                    }elseif($value->TrangThai ==4){
                      $output.= 'Chờ Xác Nhận</td>';
                    }elseif($value->TrangThai ==5){
                      $output.= 'Giao Hàng Thành Công</td>';
                    }elseif($value->TrangThai ==6){
                      $output.= 'Đã Huỷ</td>';
                    } 

                $output.='<td style="text-align: center;">';

                if($value->TT_TrangThai ==0)
                    $output.= 'Chưa Thanh Toán</td>';
                elseif($value->TT_TrangThai ==1){
                    $output.= 'Đã Thanh Toán</td>';
                }elseif($value->TT_TrangThai==2){
                    $output.= 'Thanh Toán VNPAY</td>';
                }else{
                    $output.= 'Thanh Toán MOMO</td>';
                }

                $url ='/view_order/'.$value->MSDH;
                $output.='<td>
                  <a href="'.url($url).'"><i class="material-icons">visibility</i></a>
                </td>
                </tr>
                </tbody>';
        }    
            
        echo $output;
    }

    //USER

    public function show_order(Request $re){
        $this->LoginCheck();
        $MSKH=Session::get('user_id');
        $category = DB::table('danhmuc')->get();
        $list = DB::table('loaihang')->get();

        // $orders = DB::table('dathang')->where('MSKH',$MSKH)->orderBy('MSDH','desc')->get();

        // $order_id = array();
        // foreach ($orders as $key => $value) {
        //     $order_id[] = $value->MSDH;
        // }

        // $order_details =DB::table('chitietdathang')
        // ->join('sanpham', 'chitietdathang.MSSP', '=', 'sanpham.MSSP')
        // ->select('chitietdathang.*', 'TenSP','Image','Gia')->whereIn('MSDH',$order_id)->get();

        //Các đơn hàng chưa xử lý
        $orders_unprocess = DB::table('dathang')->where('MSKH',$MSKH)->where('TrangThai',0)
        ->orderBy('MSDH','desc')->get();
        //Các đơn hàng chờ lấy hàng
        $orders_waitting = DB::table('dathang')->where('MSKH',$MSKH)->whereIn('TrangThai',[1,2])->get();
        //Các đơn hàng đang giao
        $orders_shipping = DB::table('dathang')->where('MSKH',$MSKH)->whereIn('TrangThai',[3,4])->get();
        //Các đơn hàng thành công
        $orders_delivered = DB::table('dathang')->where('MSKH',$MSKH)->where('TrangThai',5)->get();
        //Các đơn hàng đã huỷ
        $orders_cancel = DB::table('dathang')->where('MSKH',$MSKH)->where('TrangThai',6)->get();
        //Các đơn hàng gh không thành công
        $orders_undelivered = DB::table('dathang')->where('MSKH',$MSKH)->where('TrangThai',7)->get();

        $meta_desc="Thông Tin Đơn Hàng";
        $meta_keywords="Show Order";
        $meta_tittle="QPharmacy";
        $url=$re->url();

        return view('User.Order.order', compact('category','list','meta_desc','meta_keywords','url','orders_unprocess','orders_waitting','orders_shipping','orders_delivered','orders_cancel','orders_undelivered'));
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

        $meta_desc="Chi Tiết Đơn Hàng";
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
        $MSDH= $re->MSDH;

        //return redirect('/order_detail/2');

        $result = DB::table('dathang')->where('MSDH',$MSDH)->where('TrangThai',$status)->first();

        if ($result) {
            //Nếu đơn hàng đã cập nhật rồi không cần cập nhật nữa
            return redirect('/order_detail/'.$MSDH)->with('notice','Mật khẩu hoặc tài khoản không đúng');

        }else{
            ////Nếu đơn hàng chưa cập nhật thì cần cập nhật TrangThai
            DB::table('dathang')->where('MSDH',$MSDH)->update(['TrangThai' => $status]);

            if ($status==6) {
            //Lấy các sản phẩm của đơn hàng
                $order_details = DB::table("chitietdathang")->where('MSDH',$MSDH)->get();

                foreach ($order_details as $key => $value) {
                    $product = DB::table('sanpham')->where('MSSP', $value->MSSP)->first();

                    $quality = $value->SoLuong + $product->SoLuong;

                    DB::table('sanpham')->where('MSSP', $value->MSSP)->update(['SoLuong' => $quality]);
                }
            }
            return Redirect::to('/show_order');
        }

    }
}

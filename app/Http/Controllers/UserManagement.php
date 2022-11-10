<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;
use Session;
use Auth;
session_start();

class UserManagement extends Controller
{
    //Admin
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

    public function user(){
        $this->AuthLogin();
    	$id = Session::get('admin_id');
    	$infor = DB::table('nhanvien')->where('MSNV',$id)->get();
    	$manage_infor = view('admin.User.user')->with('staff_infor',$infor);
    	return view('admin_layout')->with('admin.User.user',$manage_infor);
    	// return view('admin.update_user');
    }

    public function update_user(Request $re){
        $this->AuthLogin();
    	$data = array();
    	$id = Session::get('admin_id');
    	$data['HoTenNV'] = $re->HoTen;
    	$data['GioiTinh'] = $re->GioiTinh;
    	$data['Email'] = $re->Email;
    	$data['DiaChi'] = $re->DiaChi;
    	$data['SDT'] = $re->SDT;
    	$data['Ngay'] = $re->Ngay;
    	$data['Thang'] = $re->Thang;
    	$data['Nam'] = $re->Nam;

        $get_image = $re->file('Avatar');

        if($get_image){
            $get_name = $get_image->getClientOriginalName();
            $name = current(explode('.', $get_name));
            $new_image = $name.time() .'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/backend/images/avatar',$new_image);
            $data['Avatar']=$new_image;
            DB::table('nhanvien')->where('MSNV',$id)->update($data);
            return Redirect::to('/user');
        }

        DB::table('nhanvien')->where('MSNV',$id)->update($data);
        return Redirect::to('/user');
    }

    public function password(){
        return view('admin.User.password');
    }

    public function change_pass(Request $re){
        $id = Session::get('admin_id');
        $Email= $re->Email;
        $MatKhau = $re->MatKhau;

        $result = DB::table("nhanvien")->where('MSNV',$id)->first();

        if($result->Email==$Email){
            DB::table('nhanvien')->where('MSNV',$id)->update(['MatKhau'=>md5($MatKhau)]);
            echo 1;
        }else{
            echo 0;
        }
    }

    //User interface
    public function user_register(Request $re){
        //Seo
        $meta_desc="Trang đăng ký";
        $meta_keywords="Register";
        $url=$re->url();
        // end seo
        $all_category = DB::table('danhmuc')->get();

        $loaihang = DB::table('loaihang')->get();

        return view('user.User.register')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('url',$url);
    }

    public function user_login(Request $re){
        //Seo
        $meta_desc="Trang đăng nhập";
        $meta_keywords="Login";
        $url=$re->url();
        // end seo

        $all_category = DB::table('danhmuc')->get();

        $loaihang = DB::table('loaihang')->get();

        return view('user.User.login_home')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('url',$url);
    }

    public function login(Request $request){
        $Email=$request->Email;
        $MatKhau=md5($request->MatKhau);
        $result = DB::table('khachhang')->where('Email',$Email)->where('MatKhau',$MatKhau)->first();
        if ($result) {
            Session::put('user_name',$result->Email);
            Session::put('user_id',$result->MSKH);
            Session::forget(['coupon_id', 'coupon_type', 'coupon_price', 'coupon_code']);
            return redirect('/home');
        }else{
            return redirect('/login_home')->with('notice','Mật khẩu hoặc tài khoản không đúng');
        }
    }

    public function register(Request $request){
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $mk=$request->MatKhau;
        $mk1=$request->MatKhau1;

        if($mk==$mk){
            $data['HoTenKH'] = $request->HoTenKH;
            $data['GioiTinh'] = $request->GioiTinh;
            $data['Email'] = $request->Email;
            $data['SDT'] = $request->SDT;
            $data['NgaySinh'] = $request->NgaySinh;
            $data['MatKhau']=md5($request->MatKhau);
            $data['TrangThai']=1;
            $data['created_at'] = $now;
            $data['updated_at'] = $now;

            DB::table('khachhang')->insert($data);
            return Redirect::to('/login_home');
        }
    }

    public function user_logout(){
        Session::forget(['coupon_id', 'coupon_type', 'coupon_price', 'cart', 'user_id','user_name']);
        return redirect('/home');
    }

    //Account user
    public function my_account(Request $re){
        $this->LoginCheck();
        $MSKH=Session::get('user_id');
        //Seo
        $meta_desc="Tài khoản của tôi";
        $meta_keywords="My Account";
        $url=$re->url();
        // end seo
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        //Thông tin cá nhân
        $user_infor= DB::table('khachhang')->where('MSKH', $MSKH)->first();

        return view('User.User.my_account')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('user_infor',$user_infor)
        ->with('meta_desc',$meta_desc)->with('url',$url)
        ->with('meta_keywords',$meta_keywords);
    }

    public function change_password(Request $request){
        $MSKH=Session::get('user_id');
        $Username=$request->username;
        $New_pass=md5($request->new_pwd);
        $Confirm_pass=md5($request->confirm_pwd);

        $result= DB::table('khachhang')->where('MSKH',$MSKH)->first();
        if ($result->TaiKhoan==$Username) {
            DB::table('khachhang')->where('MSKH',$MSKH)->update(['MatKhau'=>$New_pass]);
            return Redirect::to('/my_account');
        }else{
            return redirect('/my_account')->with('notice','Tài khoản không đúng');
        }
    }

    public function change_info(Request $request){
        $data = array();
        $this->LoginCheck();
        $MSKH=Session::get('user_id');
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        if($MSKH){

            $HoTenKH = $request->HoTenKH;
            $GioiTinh = $request->GioiTinh;
            $SoDienThoai = $request->SDT;
            $NgaySinh = $request->NgaySinh;

            $get_image = $request->file('Avatar');

            if($get_image){
                $get_name = $get_image->getClientOriginalName();
                $name = current(explode('.', $get_name));
                $new_image = $name.time() .'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public\frontend\assets\images\Avatar',$new_image);
                $Avatar=$new_image;
                DB::table('khachhang')->where('MSKH',$MSKH)->update([
                    'HoTenKH'   => $HoTenKH, 
                    'GioiTinh'  => $GioiTinh,
                    'NgaySinh'  => $NgaySinh,
                    'SDT'       => $SoDienThoai,
                    'Avatar'    => $Avatar,
                    'updated_at'=> $now
                ]);
                return Redirect::to('/my_account');
            }
            DB::table('khachhang')->where('MSKH',$MSKH)->update([
                'HoTenKH'   => $HoTenKH, 
                'GioiTinh'  => $GioiTinh,
                'NgaySinh'  => $NgaySinh,
                'SDT'       => $SoDienThoai,
                'updated_at'=> $now
            ]);
            return Redirect::to('/my_account');        
        }
    }

    public function show_address(Request $re){
        $this->LoginCheck();
        $MSKH=Session::get('user_id');
        //Seo
        $meta_desc="Tài khoản của tôi";
        $meta_keywords="My Address Ship";
        $url=$re->url();

        $address = array();

        $address_ship= DB::table('diachikh')->where('MSKH',$MSKH)->get();

        
        foreach ($address_ship as $key => $value) {
            $infor_province = DB::table('tinhthanhpho')->where('tinhthanhpho.matp',$value->matp)->first();
            $infor_district = DB::table('quanhuyen')->where('maqh',$value->maqh)->first();
            $infor_hamlet = DB::table('xaphuongthitran')->where('xaid',$value->xaid)->first();

            $address[] = array(
                'MaDC'     => $value->MaDC,
                'HoTen'    => $value->HoTen,
                'SDT'      => $value->SDT,
                'DiaChi'   => $value->DiaChi,
                'province' => $infor_province->name,
                'district' => $infor_district->name,
                'hamlet'   => $infor_hamlet->name
            );
        }

        $category = DB::table('danhmuc')->get();
        $list = DB::table('loaihang')->get();

        $province = DB::table('tinhthanhpho')->get();
        
        return view('User.User.address', compact('category','list','address','meta_desc','meta_keywords','url','province'));

    }

    public function address_detail(Request $re){
        $MaDC = $re->MaDC;
        $result = DB::table('diachikh')->where('MaDC',$MaDC)->first();
        $data = array();
        $data['HoTen']=$result->HoTen;
        $data['MaDC']=$result->MaDC;
        $data['SDT']=$result->SDT;
        $data['DiaChi']=$result->DiaChi;
        $data['matp'] = $result->matp;
        $data['maqh'] = $result->maqh;
        $data['xaid'] = $result->xaid;

        echo json_encode($data);
    }

    public function add_address(Request $re){
        $this->LoginCheck();
        $MSKH=Session::get('user_id');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data=array();

        $data['HoTen']=$re->HoTen;
        $data['SDT']=$re->SDT;
        $data['DiaChi']=$re->DiaChi;
        $data['MSKH']= $MSKH;
        $data['matp']= $re->province;
        $data['maqh']=$re->district;
        $data['xaid']=$re->hamlet;
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $re = DB::table('diachikh')->insert($data);
        if($re){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function update_address(Request $re){
        $this->LoginCheck();
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        DB::table('diachikh')->where('MaDC',$re->MaDC)->update([
            'HoTen'   => $re->HoTen, 
            'SDT'  => $re->SDT,
            'DiaChi'  => $re->DiaChi,
            'updated_at'=> $now
        ]);
        return Redirect::to('/show_address');
    }
}

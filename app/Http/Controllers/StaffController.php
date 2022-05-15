<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;

function vn_to_str ($str){

    $unicode = array(

        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

        'd'=>'đ',

        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

        'i'=>'í|ì|ỉ|ĩ|ị',

        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

        'D'=>'Đ',

        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );
    foreach($unicode as $nonUnicode=>$uni){
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = str_replace(' ','',$str);
    return $str;
}

class StaffController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function show_staff(){
        $this->AuthLogin();
    	$admin = Session::get('admin_id');
        Session::put('page',3);
    	$staff = DB::table('nhanvien')->whereNotIn('MSNV', [$admin])->get();
    	return view('admin.Staff.staff_management')->with('staff',$staff);
    }

    public function add_staff(){
        $this->AuthLogin();
    	return view('admin.Staff.add_staff');
    }

    public function save_staff(Request $re){
        $this->AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
    	// $data=$re->all();
        $user_name = vn_to_str($re->HoTenNV);
        $data= array();
        $data['HoTenNV'] = $re->HoTenNV;
        $data['GioiTinh'] = $re->GioiTinh;
        $data['Email'] = $re->Email;
        $data['SDT'] = $re->SDT;
        $data['DiaChi']= $re->DiaChi;
        $data['ChucVu']=$re->ChucVu;
        $data['Ngay'] = $re->Ngay;
        $data['Thang'] = $re->Thang;
        $data['Nam'] = $re->Nam;
        $data['MatKhau']=md5(123456);
        $data['Avatar']='avatar_macdinh.jpeg';
        $data['TrangThai']=1;
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $result = DB::table('nhanvien')->insert($data);
        if($result){
            return Redirect::to('staff_management');
        }
    }

    public function delete_staff($id){
        $this->AuthLogin();
        DB::table('nhanvien')->where('MSNV',$id)->update(['TrangThai'=>0]);
        return Redirect::to('staff_management');
    }

    public function unblock_staff($id){
        $this->AuthLogin();
        DB::table('nhanvien')->where('MSNV',$id)->update(['TrangThai'=>1]);
        return Redirect::to('staff_management');
    }
}

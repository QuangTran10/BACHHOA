<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CommentController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //User interface
    public function load_comment(Request $re){
    	$MSHH = $re->id_product;
    	$comment_by_id= DB::table('binhluan')
    	->join('khachhang', 'khachhang.MSKH', '=', 'binhluan.MSKH')->where('binhluan.MSSP',$MSHH)->where('binhluan.TrangThai',1)->get();
    	$output='';
        if ($comment_by_id) {

        	foreach ($comment_by_id as $key => $value) {
        		$output.='
                <div class="customer-review">
                    <div class="row">
                        <div class="col-12 col-sm-3 col-lg-2 col-xxl-1">
                            <div class="customer-review_left">
                                <div class="customer-review_img text-center">
                                    <img class="img-fluid" src="'.url('public/frontend/assets/images/avatar.jpeg').' " alt="customer image">
                                </div>
                                <div class="customer-rate"> ';
                                for ($i=1; $i <= $value->DanhGia; $i++) { 
                                    $output.='<i class="icon_star"></i>';
                                }
                $output.='  
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-9 col-lg-10 col-xxl-11">
                            <div class="customer-comment"> 
                                <h5 class="comment-date">'. Carbon::parse($value->ThoiGian)->format('d/m/Y').'</h5>
                                <h3 class="customer-name">'.$value->Email.'</h3>
                                <p class="customer-commented" style="wid">'.$value->NoiDung.'</p>
                            </div>
                        </div>
                    </div> 
                </div>';
        	} 
        }

    	echo $output;
    }

    public function add_comment(Request $re){
    	$MSKH=Session::get('user_id');
    	$MSSP=$re->id_product;
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

    	$data=array();
    	$data['MSSP']=$MSSP;
    	$data['MSKH']=$MSKH;
    	$data['NoiDung']=$re->content;
    	$data['ThoiGian']=$now;
    	$data['DanhGia']=$re->rating;
    	$data['TrangThai']=1;

    	DB::table('binhluan')->insert($data);

    }


    //admin interface
    public function show_comment(){
        $this->AuthLogin();
        $comment_by_id= DB::table('binhluan')
        ->join('khachhang', 'khachhang.MSKH', '=', 'binhluan.MSKH')
        ->join('sanpham', 'sanpham.MSSP', '=', 'binhluan.MSSP')
        ->select('binhluan.*','Email','Image')
        ->get();
        Session::put('page',8);
        return view('admin.Comment.show_comment')->with('comment',$comment_by_id);
    }

}

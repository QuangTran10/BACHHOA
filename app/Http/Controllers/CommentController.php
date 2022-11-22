<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Category;
use Auth;
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

    public function LoginCheck(){
        $MSKH=Session::get('user_id');
        if($MSKH){
            
        }else{
            return Redirect::to('login_home')->send();
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
                                    <img class="img-fluid" src="'.url('public/frontend/assets/images/Avatar/avatar.jpeg').' " alt="customer image">
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
                                <p class="customer-commented" >'.$value->NoiDung.'</p>
                            </div>
                        </div>
                    </div> 
                </div>';
        	} 
        }

    	echo $output;
    }

    public function rating_product(Request $request, $id){
        $this->LoginCheck();
        $category = DB::table('danhmuc')->get();
        $list = DB::table('loaihang')->where('TrangThai',1)->get();

        $meta_desc="Đánh giá đơn hàng";
        $meta_keywords="Rating";
        $meta_tittle="BEE STORE";
        $url=$request->url();

        //Những order đã đánh giá
        $rating = DB::table('binhluan')
        ->join('sanpham', 'binhluan.MSSP', '=', 'sanpham.MSSP')
        ->where('MSDH',$id)->get();

        $order_id_rating = array();

        foreach ($rating as $key => $value) {
            $order_id_rating[] = $value->MSSP;
        }

        //Những order chưa đánh giá
        $order_unrating = DB::table('chitietdathang')
        ->join('sanpham', 'chitietdathang.MSSP', '=', 'sanpham.MSSP')
        ->where('MSDH',$id)->whereNotIn('chitietdathang.MSSP',$order_id_rating)->get();

        $order_rating = DB::table('chitietdathang')
        ->join('sanpham', 'chitietdathang.MSSP', '=', 'sanpham.MSSP')
        ->where('MSDH',$id)->whereIn('chitietdathang.MSSP',$order_id_rating)->get();

        // echo '<pre>';
        // print_r($order_rating);
        // print_r($order_unrating);
        // echo '</pre>';

        

        return view('user.Order.rating', compact('category','list','meta_desc','meta_keywords','url','order_unrating','order_rating'));
    }

    public function add_comment(Request $re){
    	$MSKH=Session::get('user_id');
        $da = $re->all();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

        if($MSKH != null){
            //Kiểm tra sản phẩm đã được đánh giá chưa
            $result = DB::table('binhluan')
            ->where('MSSP',$da['MSSP'])->where('MSKH',$MSKH)->where('MSDH',$da['MSDH'])->get()->count();

            if($result==0){
                $data=array();
                $data['MSSP']=$da['MSSP'];
                $data['MSKH']=$MSKH;
                $data['NoiDung']=$da['NoiDung'];
                $data['ThoiGian']=$now;
                $data['MSDH'] = $da['MSDH'];
                $data['DanhGia']=$da['DanhGia'];
                $data['TrangThai']=0;

                DB::table('binhluan')->insert($data);
                echo 1; //Thành công
            }else{
                echo 2; //Đã bình luận rồi
            }
        }else{
            echo 0; //chưa đăng nhập
        }
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

    public function status_comment(Request $request){
        $this->AuthLogin();

        $MaBinhLuan = $request->id_comment;
        $TrangThai  = $request->status;

        $result = DB::table('binhluan')->where('MaBinhLuan',$MaBinhLuan)->update(['TrangThai' => $TrangThai]);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

}

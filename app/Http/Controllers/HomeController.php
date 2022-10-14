<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Roles;
use Auth;
use App\Jobs\SendEmail;
use Session;

class HomeController extends Controller
{
    public function index(Request $re){
        //Seo
        $meta_desc="BEE";
        $meta_keywords="Trang Chủ";
        $url=$re->url();
        // end seo

    	$all_category = DB::table('danhmuc')->get();

        $loaihang = DB::table('loaihang')->get();

        $province = DB::table('tinhthanhpho')->get();

        //Sản phẩm bán chạy
        $bestsell = DB::table('chitietdathang')
        ->select(DB::raw('COUNT(MSSP) as sl', 'MSSP'),'MSSP')->groupBy('MSSP')->orderBy('sl','Desc')
        ->limit(8)->get();
        $pro_best_seller = array();
        foreach ($bestsell as $key => $value) {
            $pro_best_seller[]=DB::table('sanpham')
            ->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
            ->where('MSSP',$value->MSSP)
            ->select('sanpham.*','danhmuc.TenDanhMuc')->first();
        }

        //Sản Phẩm nổi bật
        $a = DB::table('binhluan')
        ->select(DB::raw('round(AVG(DanhGia),0) as evaluate'),'MSSP')->groupBy('MSSP')
        ->groupBy('MSSP')->limit(8)->get();

        $pro_best_rate = array();
        foreach ($a as $key => $value) {
            $pro_best_rate[]=DB::table('sanpham')
            ->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
            ->where('MSSP',$value->MSSP)
            ->select('sanpham.*','danhmuc.TenDanhMuc')->first();
        }
        
        //Sản phẩm tiêu biểu
        $new_product = DB::table('sanpham')
        ->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
        ->orderBy('MSSP','desc')->limit(8)->select('sanpham.*','danhmuc.TenDanhMuc')->get();

        $meat = DB::table('sanpham')->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
        ->whereIn('sanpham.MaDM', [1, 2])->limit(8)->select('sanpham.*','danhmuc.TenDanhMuc')->get();

        $seafood = DB::table('sanpham')->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
        ->where('sanpham.MaDM',3)->limit(8)->select('sanpham.*','danhmuc.TenDanhMuc')->get();

        $vegetables = DB::table('sanpham')->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
        ->where('sanpham.MaDM',4)->limit(8)->select('sanpham.*','danhmuc.TenDanhMuc')->get();

        $drinks = DB::table('sanpham')->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
        ->where('sanpham.MaDM',6)->limit(8)->select('sanpham.*','danhmuc.TenDanhMuc')->get();

        $sale_product = DB::table('sanpham')->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
        ->where('sanpham.GiamGia', '>', 0)->limit(6)->select('sanpham.*','danhmuc.TenDanhMuc')->get();

    	return view('user.home')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('url',$url)
        ->with('pro_best_seller',$pro_best_seller)->with('meat', $meat)
        ->with('new_product',$new_product)->with('seafood', $seafood)
        ->with('vegetables', $vegetables)->with('drinks',$drinks)
        ->with('sale_product', $sale_product)->with('product_rate',$pro_best_rate);
    }

    public function search(Request $re){
        if(isset($_GET['key'])){
            $key = $_GET['key'];
        }
        //Seo
        $meta_desc="Tìm kiếm";
        $meta_keywords=$key;
        $url=url()->current();
        // end seo

        $product_search=DB::table('sanpham')
        ->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
        ->where('TenSP','like','%'.$key.'%')
        ->orderBy('MSSP','ASC')
        ->Paginate(9);

    	$all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

    	return view('user.Product.search_product')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('product',$product_search)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('url',$url);
    }

    public function contact_us(Request $re){
        $meta_desc="Liên Hệ";
        $meta_keywords="Liên hệ";
        $url=url()->current();

        $contact_list = DB::table('lienhe')->first();

        $all_category = DB::table('danhmuc')->get();

        $loaihang = DB::table('loaihang')->get();

        return view('user.Contact.contact')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('url',$url)->with('contact_list',$contact_list);
    }

    public function about_us(Request $re){
        $meta_desc="Giới Thiệu";
        $meta_keywords="Giới Thiệu";
        $url=url()->current();

        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        $subscribers = DB::table('khachhang')->get()->count();

        $products = DB::table('sanpham')->get()->count();

        return view('user.Contact.about_us')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('url',$url)->with('subscribers', $subscribers)->with('products',$products);
    }

    public function error_payment(Request $re){
        $meta_desc="ERROR";
        $meta_keywords="ERROR";
        $url=url()->current();

        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        $message = "THANH TOÁN KHÔNG THÀNH CÔNG";
        $contend = "Vui lòng kiểm tra tài khoản thanh toán hoặc số tiền còn trong tài khoản";

        return view('User.Error.error')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('url',$url)
        ->with('message',$message)->with('contend',$contend);
    }

    public function example(){
        $ship = DB::table('khachhang')->where('MSKH',3)->first();
    }

}

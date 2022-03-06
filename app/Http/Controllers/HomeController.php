<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;

class HomeController extends Controller
{
    public function index(Request $re){
        //Seo
        $meta_desc="BACH HOA";
        $meta_keywords="Trang Chủ";
        $meta_tittle="QPharmacy";
        $url=$re->url();
        // end seo

    	$all_category = DB::table('danhmuc')->get();

        $loaihang = DB::table('loaihang')->get();

        $bestsell = DB::table('chitietdathang')
        ->select(DB::raw('COUNT(MSSP) as sl', 'MSSP'),'MSSP')->groupBy('MSSP')->orderBy('sl','Desc')
        ->limit(6)->get();
        $pro_best_seller=array();
        foreach ($bestsell as $key => $value) {
            $pro_best_seller[]=DB::table('sanpham')
            ->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
            ->where('MSSP',$value->MSSP)
            ->select('sanpham.*','danhmuc.TenDanhMuc')->first();
        }
        
        //Sản phẩm nổi bật
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
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('pro_best_seller',$pro_best_seller)->with('meat', $meat)
        ->with('new_product',$new_product)->with('seafood', $seafood)
        ->with('vegetables', $vegetables)->with('drinks',$drinks)
        ->with('sale_product', $sale_product);
    }

    public function search(Request $re){
        if(isset($_GET['key'])){
            $key = $_GET['key'];
        }
        //Seo
        $meta_desc="Tìm kiếm";
        $meta_keywords=$key;
        $meta_tittle="BACHHOA.COM";
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
        ->with('meta_keywords',$meta_keywords)->with('meta_tittle',$meta_tittle)
        ->with('url',$url);
    }

    public function contact_us(Request $re){
        $meta_desc="Liên Hệ";
        $meta_keywords="Liên hệ";
        $meta_tittle="BACHHOA.COM";
        $url=url()->current();

        $contact_list = DB::table('lienhe')->first();

        $all_category = DB::table('danhmuc')->get();

        $loaihang = DB::table('loaihang')->get();

        return view('User.Contact.contact')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('contact_list',$contact_list);
    }
}

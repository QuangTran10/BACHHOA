<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
session_start();

class CateChildController extends Controller
{
    //ADMIN
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function catechild_management(){
    	$this->AuthLogin();
        Session::put('page',6);
    	$all_category_child = DB::table('danhmuc')->join('loaihang', 'loaihang.MaLoai', '=', 'danhmuc.MaLoai')->get();
    	$manage_category = view('admin.CateChild.catechild_management')->with('all_category',$all_category_child);
    	return view('admin_layout')->with('admin.CateChild.catechild_management',$manage_category);
    }

    public function add(){
    	$this->AuthLogin();
    	$all_category = Category::all();
    	return view('admin.CateChild.add_catechild')->with('all_category', $all_category);
    }

    public function save_catechild(Request $re){
    	$this->AuthLogin();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

        $data = array();
        $data['MaLoai']= $re->MaLoai;
        $data['TenDanhMuc'] = $re->TenDanhMuc;
        $data['created_at'] = $now;
    	$data['updated_at'] = $now;
    	DB::table('danhmuc')->insert($data);
    	return Redirect::to('catechild_management');
    }

    public function update_catechild($id){
    	$this->AuthLogin();
    	$all_category = Category::all();
        $update_category = DB::table('danhmuc')->where('MaDM',$id)->get();
        $manager_category_product  = view('admin.CateChild.update_catechild')->with('edit_category_child',$update_category)->with('category', $all_category);

        return view('admin_layout')->with('admin.edit_category_child', $manager_category_product)
        ;
    }

    public function edit_catechild(Request $re, $id){
    	$this->AuthLogin();

    	$now = Carbon::now('Asia/Ho_Chi_Minh');

        $data = array();
        $data['MaLoai']= $re->MaLoai;
        $data['TenDanhMuc'] = $re->TenDanhMuc;
        $data['created_at'] = $now;
    	$data['updated_at'] = $now;
    	DB::table('danhmuc')->where('MaDM', $id)->update($data);
    	return Redirect::to('catechild_management');
    }

    //USER
    public function show_catechild(Request $re, $id){
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        $category=DB::table('loaihang')->where('MaLoai',$id)->first();

        //Seo
        $meta_desc=$category->TenLoai;
        $meta_keywords="Category";
        $meta_tittle="BACHHOA.COM";
        $url=$re->url();
        // end seo
        if (isset($_GET['sort_by'])) {

            $sort_by= $_GET['sort_by'];

            if($sort_by=='az'){
                $product = DB::table('loaihang')
                ->join('danhmuc','danhmuc.MaLoai','=','loaihang.MaLoai')
                ->join('sanpham','sanpham.MaDM','=','danhmuc.MaDM')
                ->where('loaihang.MaLoai',$id)
                ->select('sanpham.*','danhmuc.MaDM','danhmuc.TenDanhMuc')
                ->orderBy('TenSP','ASC')->get();

            }elseif ($sort_by=='za') {

                $product = DB::table('loaihang')
                ->join('danhmuc','danhmuc.MaLoai','=','loaihang.MaLoai')
                ->join('sanpham','sanpham.MaDM','=','danhmuc.MaDM')
                ->where('loaihang.MaLoai',$id)
                ->select('sanpham.*','danhmuc.MaDM','danhmuc.TenDanhMuc')
                ->orderBy('TenSP','DESC')->get();

            }elseif ($sort_by=='increase') {

                $product = DB::table('loaihang')
                ->join('danhmuc','danhmuc.MaLoai','=','loaihang.MaLoai')
                ->join('sanpham','sanpham.MaDM','=','danhmuc.MaDM')
                ->where('loaihang.MaLoai',$id)
                ->select('sanpham.*','danhmuc.MaDM','danhmuc.TenDanhMuc')
                ->orderBy('Gia','DESC')->get();

            }elseif ($sort_by=='decrease') {

                $product = DB::table('loaihang')
                ->join('danhmuc','danhmuc.MaLoai','=','loaihang.MaLoai')
                ->join('sanpham','sanpham.MaDM','=','danhmuc.MaDM')
                ->where('loaihang.MaLoai',$id)
                ->select('sanpham.*','danhmuc.MaDM','danhmuc.TenDanhMuc')
                ->orderBy('Gia','ASC')->get();
                
            }elseif ($sort_by=='price') {
                $nho=0;
                $lon=500000;
                if(isset($_GET['MAX']) && isset($_GET['MIN'])){
                    $nho = $_GET['MIN'];
                    $lon = $_GET['MAX'];
                }

                $product = DB::table('loaihang')
                ->join('danhmuc','danhmuc.MaLoai','=','loaihang.MaLoai')
                ->join('sanpham','sanpham.MaDM','=','danhmuc.MaDM')
                ->where('loaihang.MaLoai',$id)
                ->select('sanpham.*','danhmuc.MaDM','danhmuc.TenDanhMuc')
                ->whereBetween('sanpham.Gia', [$nho, $lon])->get();

            }
            else{
                $product = DB::table('loaihang')
                ->join('danhmuc','danhmuc.MaLoai','=','loaihang.MaLoai')
                ->join('sanpham','sanpham.MaDM','=','danhmuc.MaDM')
                ->where('loaihang.MaLoai',$id)
                ->select('sanpham.*','danhmuc.MaDM','danhmuc.TenDanhMuc')
                ->orderBy('MSSP','ASC')
                ->get();
            }
        }else{
            $product = DB::table('loaihang')
            ->join('danhmuc','danhmuc.MaLoai','=','loaihang.MaLoai')
            ->join('sanpham','sanpham.MaDM','=','danhmuc.MaDM')
            ->where('loaihang.MaLoai',$id)
            ->select('sanpham.*','danhmuc.MaDM','danhmuc.TenDanhMuc')
            ->orderBy('MSSP','ASC')
            ->get();
        }


        
        return view('User.Product.show_product')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('product',$product);
    }
}

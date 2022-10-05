<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;
session_start();

class CategoryManagement extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function category_management(){
        $this->AuthLogin();
        Session::put('page',4);
    	$all_category = Category::Paginate(5);
    	$manage_category = view('admin.Category.category_management')->with('all_category',$all_category);
    	return view('admin_layout')->with('admin.Category.category_management',$manage_category);
    }

    //Chuyển trang thêm danh mục
    public function add(){
        $this->AuthLogin();
    	return view('admin.Category.add_category');
    }

    //Hàm thêm danh mục
    public function save_category(Request $re){
        $this->AuthLogin();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

        $data = $re->all();
        $cate = new Category();
        $cate->TenLoai= $data['TenLoai'];
        $cate->TrangThai= $data['TrangThai'];
        $cate->save();
    	return Redirect::to('category_management');
    }

    //Chuyển trang cập nhật danh mục
    public function update_category($category_product_id){
        $this->AuthLogin();
        $update_category = Category::find($category_product_id);
        $manager_category_product  = view('admin.Category.update_category')->with('edit_category_product',$update_category);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    //Hàm Cập nhật danh mục
    public function edit_category(Request $re, $category_product_id){
        $this->AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data = $re->all();
        $cate = Category::find($category_product_id);
        $cate->TenLoai= $data['TenLoai'];
        $cate->TrangThai= $data['TrangThai'];
        $cate->save();

        return Redirect::to('category_management');
    }

    //Chuyển trang xoá danh mục
    public function delete($category_product_id){
        $this->AuthLogin();
    	DB::table('loaihang')->where('MaLoai',$category_product_id)->update(['TrangThai'=>0]);
        return Redirect::to('category_management');
    }

    //END ADMIN 

    //USER INTERFACE
    public function show_category_home($id_cate, Request $re){
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        $category=DB::table('danhmuc')->where('MaDM',$id_cate)->get();

        if (isset($_GET['sort_by'])) {

            $sort_by= $_GET['sort_by'];

            if($sort_by=='az'){

                $category_by_id =DB::table('sanpham')->where('sanpham.MaDM',$id_cate)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('TenSP','ASC')->Paginate(9);

            }elseif ($sort_by=='za') {

                $category_by_id =DB::table('sanpham')->where('sanpham.MaDM',$id_cate)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('TenSP','DESC')->Paginate(9);

            }elseif ($sort_by=='increase') {

                $category_by_id =DB::table('sanpham')->where('sanpham.MaDM',$id_cate)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('Gia','DESC')->Paginate(9);

            }elseif ($sort_by=='decrease') {

                $category_by_id =DB::table('sanpham')->where('sanpham.MaDM',$id_cate)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('Gia','ASC')->Paginate(9);
            }elseif ($sort_by=='price') {
                $nho=0;
                $lon=500000;
                if(isset($_GET['MAX']) && isset($_GET['MIN'])){
                    $nho = $_GET['MIN'];
                    $lon = $_GET['MAX'];
                }

                $category_by_id =DB::table('sanpham')->where('sanpham.MaDM',$id_cate)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->whereBetween('sanpham.Gia', [$nho, $lon])->Paginate(9);

            }
            else{
                $category_by_id =DB::table('sanpham')->where('sanpham.MaDM',$id_cate)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('MSSP','ASC')
                ->Paginate(9);
            }
        }else{
            $category_by_id =DB::table('sanpham')->where('sanpham.MaDM',$id_cate)
            ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
            ->orderBy('MSSP','ASC')
            ->Paginate(9);
        }

        foreach ($category as $key => $value) {
            //Seo
            $meta_desc=$value->TenDanhMuc;
            $meta_keywords="Category - ". $value->MaDM;
            $url=$re->url();
            // end seo
        }
        
        return view('User.Product.show_product')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('product',$category_by_id)->with('url',$url)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords);
    }
}

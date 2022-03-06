<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Producer;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ProducerManagement extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
	//Chuyển trang show NSX
    public function producer_management(){
        $this->AuthLogin();
    	$all_producer = DB::table('nhasanxuat')->get();
        Session::put('page',6);
    	$manage_producer = view('admin.Producer.producer_management')->with('all_producer',$all_producer);
    	return view('admin_layout')->with('admin.Producer.producer_management',$manage_producer);
    }

    //Chuyển trang Thêm NSX
    public function add(){
        $this->AuthLogin();
    	return view('admin.Producer.add_producer');
    }

    //Hàm thêm NSX
    public function save_producer(Request $re){
        $this->AuthLogin();

        $data = $re->all();
        $pro = new Producer();
        $pro->TenNSX= $data['TenNSX'];
        $pro->TinhTrang= $data['TinhTrang'];
        $pro->save();

    	// DB::table('nhasanxuat')->insert($data);
    	return Redirect::to('producer_management');
    }


    //Chuyển trang cập nhật NSX
    public function update_producer($id){
        $this->AuthLogin();
        $update_producer = DB::table('nhasanxuat')->where('MaNSX',$id)->get();
        $manager_producer  = view('admin.Producer.update_producer')->with('edit_producer',$update_producer);
        return view('admin_layout')->with('admin.edit_producer', $manager_producer);
    }

    //Hàm Cập nhật NSX
    public function edit_producer(Request $re,$id){
        $this->AuthLogin();

        $data = $re->all();
        $pro = Producer::find($id);
        $pro->TenNSX= $data['TenNSX'];
        $pro->TinhTrang= $data['TinhTrang'];
        $pro->save();
        return Redirect::to('producer_management');
    }

    //Chuyển trang xoá NSX
    public function delete($id){
        $this->AuthLogin();
        DB::table('nhasanxuat')->where('MaNSX',$id)->update(['TinhTrang'=>0]);
        return Redirect::to('producer_management');
    }

    public function show_producer_home($id_pro, Request $re){
        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();

        $producer_by_id =DB::table('hanghoa')->where('hanghoa.MaNSX',$id_pro)
        ->join('nhasanxuat', 'hanghoa.MaNSX', '=', 'nhasanxuat.MaNSX')
        ->get();

        $category=DB::table('nhasanxuat')->where('MaNSX',$id_pro)->get();

        foreach ($category as $key => $value) {
            //Seo
            $meta_desc=$value->TenNSX;
            $meta_keywords="Producer - ". $value->MaNSX;
            $meta_tittle="QPharmacy";
            $url=$re->url();
            // end seo
        }
        $count_producer_by_id=DB::table('hanghoa')->where('MaNSX',$id_pro)->get()->count();
        return view('pages.category.show_category')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('product',$producer_by_id)->with('soluong',$count_producer_by_id)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url);
    }
}

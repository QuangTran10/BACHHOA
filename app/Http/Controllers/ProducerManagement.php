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
}

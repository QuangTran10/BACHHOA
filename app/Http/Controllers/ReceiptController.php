<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use App\Models\Producer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Collection;
use Session;
use Auth;
session_start();

class ReceiptController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
	//Danh sách
	public function show_all(){
        $this->AuthLogin();
        $all= DB::table('phieuthu')
        ->join('nhanvien', 'nhanvien.MSNV', '=', 'phieuthu.MSNV')
        ->join('nhasanxuat', 'nhasanxuat.MaNSX', '=', 'phieuthu.MaNCC')
        ->orderBy('MaPhieu','ASC')->get();
        Session::put('page',7);
        return view('admin.Receipt.receipt_all')->with('all_receipt', $all);
	}

    //Thêm phiếu nhập
    public function show_add(){
        $this->AuthLogin();
        $producer = Producer::all();

        $product=DB::table('sanpham')->get();

    	return view('admin.Receipt.add_receipt', compact('product', 'producer'));
    }

    //add
    public function add(Request $re){
        $this->AuthLogin();
    	$data= $re->all();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

        $total =0;
        for ($i=0; $i < $data['index']; $i++) { 
            $total += $data['Quantity'][$i]*$data['Price'][$i];
        }

    	// //Receipt
    	$receipt=array();

    	$receipt['MSNV']=Session::get('admin_id');
    	$receipt['ThanhTien']=$total;
    	$receipt['NgayLap']=$now;
    	$receipt['MaNCC']=$re->MaNCC;
    	$receipt['GhiChu']=$re->GhiChu;
    	$receipt['TinhTrang']=$re->TinhTrang;
    	$receipt['TG_Tao']=$now;
    	$receipt['TG_CapNhat']=$now;
    	
    	$MaPhieu=DB::table('phieuthu')->insertGetId($receipt);

    	$ds= array();
      for ($i=0; $i < $data['index']; $i++) { 
        $ds['MaPhieu']= $MaPhieu;
        $ds['MSSP'] = $data['Product'][$i];
        $ds['SoLuong'] = $data['Quantity'][$i];
        $ds['DonGia'] = $data['Price'][$i];
        $ds['TG_Tao']=$now;
        $ds['TG_CapNhat']=$now;

        $result=DB::table('chitietphieuthu')->insert($ds);
        if ($result) {
         $kq=1;
        }
      }

      if ($kq==1) {
        return Redirect::to('show_receipt');
      }else{
        Session::put('message','Thêm Thất bại');
        return Redirect::to('add_receipt');
      }

    }

    public function show(Request $request){
        
        $receipt = DB::table('phieuthu')
        ->join('nhanvien', 'nhanvien.MSNV', '=', 'phieuthu.MSNV')
        ->join('nhasanxuat', 'nhasanxuat.MaNSX', '=', 'phieuthu.MaNCC')
        ->where('MaPhieu', $request->MaPhieu)->select('phieuthu.*', 'nhasanxuat.Ten', 'nhanvien.HoTenNV')->first();

        $detail_receipt = DB::table('chitietphieuthu')
        ->join('sanpham', 'sanpham.MSSP', '=', 'chitietphieuthu.MSSP')
        ->select('chitietphieuthu.*', 'sanpham.TenSP')
        ->where('MaPhieu', $request->MaPhieu)->get();

        $output = '
        <h4 style="text-align: center; padding-bottom: 15px"><b>CHI TIẾT PHIẾU NHẬP HÀNG</b></h4>
        <div class="instruction">
          <div class="row">
            <div class="col-md-3">
              <b>Mã:</b> '.$receipt->MaPhieu.'
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <b>Người nhập hàng:</b> '.$receipt->HoTenNV.'
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <b>Ngày nhập hàng:</b> '.$receipt->NgayLap.'
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <b>Nhà cung cấp:</b> '.$receipt->Ten.'
            </div>
          </div>
          <div class="instruction">
          <div class="row">
          <div class="table-responsive">
          <table class="table">
          <thead class=" text-primary">
          <th>STT</th>
          <th width="40%">Tên sản phẩm</th>
          <th>Số lượng</th>
          <th>Đơn giá</th>
          <th>Tổng</th>
          </thead>
          <tbody>
          ';
          $i = 1;
          foreach ($detail_receipt as $key => $value) {
            $output .= '
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$value->TenSP.'</td>
                        <td>'.$value->SoLuong.'</td>
                        <td>'.number_format($value->DonGia , 0, ',', ' ').'đ </td>
                        <td>'.number_format($value->DonGia*$value->SoLuong , 0, ',', ' ').'đ</td>
                    </tr>';
            $i++;
          }

          $output .='
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2"><b>Tổng giá trị nhập hàng</b></td>
                        <td>'.number_format($receipt->ThanhTien , 0, ',', ' ').'đ</td>
                    </tr>
                    </tbody>
                </table>
            </div>
           </div>
         </div>
         <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Thoát</button>
         </div>
         ';

        
        echo $output; 
    }

    public function edit(Request $request, $id){
        $this->AuthLogin();
        $producer = Producer::all();

        $product=DB::table('sanpham')->get();

        $receipt = DB::table('phieuthu')->where('MaPhieu', $id)->first();

        $detail_receipt = DB::table('chitietphieuthu')->where('MaPhieu', $id)->get();

        return view('admin.Receipt.edit_receipt', compact('product', 'producer', 'receipt', 'detail_receipt'));
    }
    
    public function update(Request $request){
        $this->AuthLogin();
        $data= $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        $total =0;
        for ($i=0; $i < $data['index']; $i++) { 
            $total += $data['Quantity'][$i]*$data['Price'][$i];
        }

        $receipt = DB::table('phieuthu')->where('MaPhieu', $data['MaPhieu'])
        ->update([
            'ThanhTien' => $total,
            'GhiChu'    => $data['GhiChu'],
            'TinhTrang' => $data['TinhTrang'],
            'MaNCC'     => $data['MaNCC']
        ]);


        //Cập nhật chi tiết phiếu thu
        //B1: Xoá các record cũ
        DB::table('chitietphieuthu')->where('MaPhieu', $data['MaPhieu'])->delete();
        //B2: Cập nhật những record mới
        $ds= array();
        for ($i=0; $i < $data['index']; $i++) { 
            $ds['MaPhieu']= $data['MaPhieu'];
            $ds['MSSP'] = $data['Product'][$i];
            $ds['SoLuong'] = $data['Quantity'][$i];
            $ds['DonGia'] = $data['Price'][$i];
            $ds['TG_Tao']=$now;
            $ds['TG_CapNhat']=$now;

            $result=DB::table('chitietphieuthu')->insert($ds);
            if ($result) {
               $kq=1;
            }
        }
        //B3: Cập nhật lại số lượng

       if ($kq==1) {
            return Redirect::to('show_receipt');
        }else{
            Session::put('message','Thêm Thất bại');
            return Redirect::to('edit_receipt/'.$data['MaPhieu']);
        }
    }

    public function delete(Request $request, $id){
      echo $id;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Producer;
use App\Imports\Import;
use App\Exports\Export;
use Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Collection;
use Session;
use Auth;
use PDF;
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

    //Receipt
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

  $url = '/print_receipt/'.$request->MaPhieu;

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
  <div class="row">
  <div class="col-md-12">
  <b>Số sản phẩm:</b> '.count($detail_receipt).'
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
  <a href="'.url($url).'" class="btn btn-success btn-round" target="_blank"><i class="material-icons">print</i> In Phiếu</a>
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

public function export(Request $request){
  echo "export";
}

public function import(Request $request){
  $path = $request->file('file')->getRealPath();
  $rows = Excel::toArray(new Import(), $path);
  $message = "";

  $data = array();

  for ($i=1; $i < count($rows[0]); $i++) { 
    $result = DB::table('sanpham')->where('MSSP', $rows[0][$i][0])->first();
    if(!$result){
      $message .= "<li>Mã sản phẩm số ". $i ." không tồn tại</li>";
    }

    if($rows[0][$i][2]==0){
      $message .= "<li>Số lượng sản phẩm số ". $rows[0][$i][0] ." bằng 0</li>";

    }elseif($rows[0][$i][2]<0){
      $message .= "<li>Số lượng sản phẩm số ". $rows[0][$i][0] ." là số âm</li>";

    }

    if($rows[0][$i][3]==0){
      $message .= "<li>Giá sản phẩm số ". $rows[0][$i][0] ." bằng 0</li>";

    }elseif($rows[0][$i][3]<0){
      $message .= "<li>Giá sản phẩm số ". $rows[0][$i][0] ." là số âm</li>";
    }

    if($message ==""){
      $data[] = array(
        'MSSP'    => $rows[0][$i][0],
        'SoLuong' => $rows[0][$i][2],
        'DonGia'  => $rows[0][$i][3],
      );
    }
  }

  if($message == ""){
    return Redirect::to('add_receipt')->with('row',$data);
  }else{
    Session::put('message',$message);
    return Redirect::to('add_receipt');
  }
  
}

//In phiếu nhập hàng
public function print($code){
  $this->AuthLogin();
  $now = Carbon::now('Asia/Ho_Chi_Minh');
  $data=array();

  $contact = DB::table('lienhe')->get();

  $receipt = DB::table('phieuthu')
  ->join('nhanvien', 'nhanvien.MSNV', '=', 'phieuthu.MSNV')
  ->join('nhasanxuat', 'nhasanxuat.MaNSX', '=', 'phieuthu.MaNCC')
  ->where('MaPhieu', $code)->select('phieuthu.*', 'nhasanxuat.Ten', 'nhanvien.HoTenNV')->first();

  $detail_receipt = DB::table('chitietphieuthu')
  ->join('sanpham', 'sanpham.MSSP', '=', 'chitietphieuthu.MSSP')
  ->select('chitietphieuthu.*', 'sanpham.TenSP')
  ->where('MaPhieu', $code)->get();

  $data['contact']=$contact;
  $data['URL']='public/frontend/assets/images/bee.png';
  $data['receipt']=$receipt;
  $data['receipt_details']=$detail_receipt;

  $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.Receipt.invoice', $data);
  $name="Receipt_".$code."_".$now->day.$now->month.$now->year.".pdf";
  return $pdf->stream($name);
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
use Auth;
session_start();

class CouponController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
          return Redirect::to('dashboard');
      }else{
          return Redirect::to('admin')->send();
      }
    }

    public function index()
    {
        $this->AuthLogin();
        Session::put('page',10);

        $coupon = DB::table('magiamgia')->get();

        return view('admin.Coupon.show_coupon', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthLogin();
        return view('admin.Coupon.create_coupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->AuthLogin();
        $validate = $request->validate([
            'TieuDe'       => 'required',
            'Ma'           => 'required',
            'LoaiGiam'     => 'required',
            'MucGiam'      => 'required',
            'TrangThai'    => 'required',
            'NgayKetThuc'  => 'required',
        ],
        [
            'TieuDe.required' => "Tiêu đề không được để trống",
            'Ma.required' => "Mã không được để trống",
            'LoaiGiam.required' => "Loại giảm không được để trống",
            'MucGiam.required' => "Mức giảm không được để trống",
            'TrangThai.required' => "Trạng thái không được để trống",
            'NgayKetThuc.required' => "HSD không được để trống",
        ]
        );

        $coupon = array();
        $coupon['TieuDe'] = $request->TieuDe;
        $coupon['Ma'] = $request->Ma;
        $coupon['LoaiGiam'] = $request->LoaiGiam;
        $coupon['MucGiam'] = $request->MucGiam;
        $coupon['NgayKetThuc'] = $request->NgayKetThuc;
        $coupon['TrangThai'] = $request->TrangThai;

        DB::table('magiamgia')->insert($coupon);

        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->AuthLogin();
        $coupon = DB::table('magiamgia')->where('MaGG',$id)->first();

        return view('admin.Coupon.update_coupon', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->AuthLogin();
        $coupon = array();
        $coupon['TieuDe'] = $request->TieuDe;
        $coupon['Ma'] = $request->Ma;
        $coupon['LoaiGiam'] = $request->LoaiGiam;
        $coupon['MucGiam'] = $request->MucGiam;
        $coupon['NgayKetThuc'] = $request->NgayKetThuc;
        $coupon['TrangThai'] = $request->TrangThai;

        DB::table('magiamgia')->where('MaGG', $id)->update($coupon);

        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->AuthLogin();
        DB::table('magiamgia')->where('MaGG', $id)->update(['TrangThai' => 0]);

        return redirect()->route('coupon.index');
    }
}

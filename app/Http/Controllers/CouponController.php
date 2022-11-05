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
    public function index()
    {
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
        DB::table('magiamgia')->where('MaGG', $id)->update(['TrangThai' => 0]);

        return redirect()->route('coupon.index');
    }
}

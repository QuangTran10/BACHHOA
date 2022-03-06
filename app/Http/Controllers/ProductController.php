<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add(){
        $this->AuthLogin();
    	$all_category = DB::table('danhmuc')->get();
    	return view('admin.Product.add_product')->with('category',$all_category);
    }

    public function product_management(){
        $this->AuthLogin();
        $all_product = DB::table('sanpham')
        ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
        ->simplePaginate(5);
        Session::put('page',2);
        $manage_product = view('admin.Product.product_management')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.Product.product_management',$manage_product);
    }

    public function save_product(Request $re){
        $this->AuthLogin();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$data = array();
        //upload ảnh
        $get_image = $re->file('HinhAnh');

    	$data['TenSP'] = $re->TenHangHoa;
    	$data['Gia'] = $re->Gia;
    	$data['SoLuong'] = $re->SoLuong;
    	$data['MaDM'] = $re->DanhMuc;
    	$data['ThongTin'] = $re->MoTa;
        $data['GiamGia']=0;
    	$data['TrangThai'] = $re->TrangThai;
    	$data['created_at'] = $now;
    	$data['updated_at'] = $now;
        if($get_image){
            //Upload ảnh lên thư mục
            $image0 =$get_image[0];
            $get_name0 = $image0->getClientOriginalName();
            $name0 = current(explode('.', $get_name0));
            $new_image0 = $name0.time() .'.'.$image0->getClientOriginalExtension();
            $get_image[0]->move('public/upload',$new_image0);
            $data['Image']=$new_image0;
        }        

        $MSSP = DB::table('sanpham')->insertGetId($data);
    	

        if($get_image){
            foreach ($get_image as $key => $image) {
                if ($key!=0) {
                    $img = array();
                    //Upload ảnh lên thư mục
                    $get_name = $image->getClientOriginalName();
                    $name = current(explode('.', $get_name));
                    $new_image = $name.time() .'.'.$image->getClientOriginalExtension();
                    //$image->move('public/upload',$new_image);
                    $image->move('public/upload', $new_image);
                    //Insert vào csdl
                    $img['MSSP']=$MSSP;
                    $img['HinhAnh']=$new_image;
                    $img['created_at'] = $now;
                    $img['updated_at'] = $now;
                    DB::table('hinhanh')->insert($img);
                }
            }
        }
        return Redirect::to('product_management');
    }

    public function update_product($id){
        $this->AuthLogin();
        $all_product = DB::table('sanpham')->where('MSSP',$id)->get();
        $all_category = DB::table('danhmuc')->get();
        return view('admin.Product.update_product')->with('all_product',$all_product)->with('category',$all_category);
    }

    //Hàm cập nhật sản phẩm
    public function edit_product(Request $re,$id){
        $this->AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        
        $data['TenSP'] = $re->TenHangHoa;
        $data['Gia'] = $re->Gia;
        $data['SoLuong'] = $re->SoLuong;
        $data['MaDM'] = $re->DanhMuc;
        $data['ThongTin'] = $re->ThongTin;
        $data['GiamGia']=$re->GiamGia;
        $data['TrangThai'] = $re->TrangThai;
        $data['created_at'] = $re->created_at;
        $data['updated_at'] = $now;

        DB::table('sanpham')->where('MSSP',$id)->update($data);
        //upload ảnh
        $get_image = $re->file('HinhAnh');

        
        if($get_image){
            foreach ($get_image as $image) {
                $img = array();
                //Upload ảnh lên thư mục
                $get_name = $image->getClientOriginalName();
                $name = current(explode('.', $get_name));
                $new_image = $name.time() .'.'.$image->getClientOriginalExtension();
                //$image->move('public/upload',$new_image);
                $image->move('public/upload', $new_image);
                //Insert vào csdl
                $img['MSSP']=$id;
                $img['HinhAnh']=$new_image;
                $img['created_at'] = $now;
                $img['updated_at'] = $now;
                DB::table('hinhanh')->insert($img);
            }
        }

        
        return Redirect::to('product_management');
    }

    //Chuyển trang xoá SP
    public function delete($id,$hinhanh){
        $this->AuthLogin();
        DB::table('sanpham')->where('MSHH',$id)->update(['TrangThai'=>0]);
        return Redirect::to('product_management');
    }

    //Các sp bán chạy
    public function best_sell(Request $re){
        $bestsell = DB::table('chitietdathang')
        ->select(DB::raw('COUNT(MSSP) as sl', 'MSSP'),'MSSP')->groupBy('MSSP')
        ->orderBy('sl','Desc')
        ->limit(5)->get();

        $labels=array();
        $series=array();
        foreach ($bestsell as $key => $value) {
            $labels[]=$value->MSSP;
            $series[]=$value->sl;
        }
        $chart_data = array(
            'labels' => $labels,
            'series' => $series
        );

       echo $data = json_encode($chart_data);
    }

    //Ảnh sản phẩm

    public function images_product(){
        $product = DB::table('hinhanh')->join('sanpham', 'sanpham.MSSP', '=', 'hinhanh.MSSP')
        ->select('sanpham.MSSP','HinhAnh', 'TenSP', 'ID')->simplePaginate(5);;
        return view('admin.Images.images_product')->with('images',$product);
    }

    public function delete_images($id){
        $result = DB::table('hinhanh')->where('ID', $id)->delete();
        if ($result) {
           return Redirect::to('images_product');
        }

    }

    //END ADMIN

    public function show_all_product(Request $re){
        $all_category = DB::table('loaisanpham')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();

        $product_all =DB::table('sanpham')->where('TrangThai',1)->get();

        if (isset($_GET['sort_by'])) {

            $sort_by= $_GET['sort_by'];

            if($sort_by=='az'){

                $product_all =DB::table('sanpham')->where('TrangThai',1)->orderBy('TenHH','ASC')->get();

            }elseif ($sort_by=='za') {

                $product_all =DB::table('sanpham')->where('TrangThai',1)->orderBy('TenHH','DESC')->get();

            }elseif ($sort_by=='increase') {

                $product_all =DB::table('sanpham')->where('TrangThai',1)->orderBy('Gia','ASC')->get();

            }elseif ($sort_by=='decrease') {

                $product_all =DB::table('sanpham')->where('TrangThai',1)->orderBy('Gia','DESC')->get();
                
            }
        }else{
            $product_all =DB::table('sanpham')->where('TrangThai',1)->orderBy('MSHH','ASC')->get();
        }

        //Seo
        $meta_desc="Tất cả sản phẩm";
        $meta_keywords="All Product";
        $meta_tittle="QPharmacy";
        $url=$re->url();
        // end seo

        $count_product_all=DB::table('sanpham')->where('TrangThai',1)->get()->count();
        return view('pages.category.show_category')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('product',$product_all)->with('soluong',$count_product_all)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url);
    }

    public function product_detail($id,  Request $re){
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        $product_detail = DB::table('sanpham')
        ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')->where('sanpham.MSSP',$id)->first();
        $images_product = DB::table('hinhanh')->where('MSSP',$id)->limit(3)->get();

        $MaDM=$product_detail->MaDM;
            //Seo
        $meta_desc=$product_detail->TenSP;
        $meta_keywords="Product Detail - ". $id;
        $meta_tittle=$product_detail->TenSP;
        $url=$re->url();
        // end seo

        $reviews=DB::table('binhluan')->where('MSSP',$id)->get();
        $count=0;
        $total=0;
        foreach ($reviews as $k => $val) {
            $count++;
            $total=$total+$val->DanhGia;
        }
        if ($count==0) {
            $total=0;
        }else{
            $total=round($total/$count);
        }
        
        $related_product = DB::table('sanpham')
        ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
        ->where('sanpham.MaDM',$MaDM)->whereNotIn('sanpham.MSSP',[$id])->get();


        return view('User.Product.product_details')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('product_detail',$product_detail)->with('images_product', $images_product)
        ->with('related_product',$related_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('count_reviews',$count)->with('Total',$total);
    }

    //quick_view
    public function quick_view(Request $re){
        $id_product= $re->id_product;
        $output= array();
        $product_detail = DB::table('sanpham')
        ->join('danhmuc', 'danhmuc.MaDM', '=', 'sanpham.MaDM')
        ->where('MSSP',$id_product)->select('sanpham.*','danhmuc.TenDanhMuc')->get();

        $images_product = DB::table('hinhanh')->where('MSSP',$id_product)->limit(3)->get();

        // $reviews=DB::table('binhluan')->where('MSHH',$id_product)->get();
        // $count=0;
        // $total=0;
        // foreach ($reviews as $k => $val) {
        //     $count++;
        //     $total=$total+$val->DanhGia;
        // }
        // $output['rating']='';
        // if ($count==0) {
        //     $total=0;
        // }else{
        //     $total=round($total/$count);
        //     for ($i=1; $i <=$total ; $i++) { 
        //         $output['rating'].='<span><i class="lnr lnr-star"></i></span>';
        //     }
        // }

        foreach ($product_detail as $key => $value) {
            $output['MSSP']=$value->MSSP;
            $output['TenSP']='<a class="product-name" href="'.url('/product_details/ '.$value->MSSP.'').'">'.$value->TenSP.'</a>';
            $output['DanhMuc'] = $value->TenDanhMuc;
            $output['Gia']=number_format($value->Gia, 0, ',', ' ')."đ";
            $output['SoLuong']='Còn '.$value->SoLuong.' sản phẩm trong kho';
            $output['ThongTin']=$value->ThongTin;
            $url = '/public/upload/'.$value->Image;

            $output['Image']='<div class="shop-detail_img">
                <button class="round-icon-btn" id="zoom-btn">
                    <i class="icon_zoom-in_alt"></i>
                </button>
                <div class="big-img big-img_qv">
                    <div class="big-img_block">
                        <img src=" '.url($url).'" alt="product image">
                    </div>
                </div>
                <div class="slide-img slide-img_qv">
                    <div class="slide-img_block">
                        <img src="'.url($url).'" alt="product image">
                    </div>
                </div>
            </div> ';

            // $output['quickview_value']='
            //     <input type="hidden" name="Id_'.$value->MSHH.'" value="'.$value->MSHH.'" class="cart_product_id_'.$value->MSHH.'">
            //     <input type="hidden" name="Name" value="'.$value->TenHH.'" class="cart_product_name_'.$value->MSHH.'">
            //     <input type="hidden" name="Image" value="'.$value->hinhanh1.'" class="cart_product_image_'.$value->MSHH.'">
            //     <input type="hidden" name="Price" value="'.$value->Gia.'" class="cart_product_price_'.$value->MSHH.'">
            //     <input type="hidden" name="Discount" value="'.$value->GiamGia.'" class="cart_product_discount_'.$value->MSHH.'">
            //     <input type="hidden" name="SoLuong" value="1" class="cart_product_qty_'.$value->MSHH.'">';
            // $output['button_quickview']='
            // <a class="btn btn-cart2" href="#">Thêm Vào Giỏ Hàng</a>';   
        }

        // $output['review']='<span>'.$count.' Đánh Giá</span>';
        echo json_encode($output);
    }

    //Yêu thích
    public function favourite_product(Request $request){
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data=array();
        $notification=array();

        $MSKH=Session::get('user_id');
        if ($MSKH) {
            $MSHH = $request->id_product;
            $data['MSKH']=$MSKH;
            $data['MSSP']=$MSHH;
            $data['created_at']=$now;
            $data['updated_at']=$now;

            $re = DB::table('yeuthich')->where('MSKH',$MSKH)->where('MSSP',$MSHH)->select('Ma')->get();
            $Ma=null;
            foreach ($re as $key => $value) {
                $Ma = $value->Ma;
            }
            if($Ma==null){
                $result = DB::table('yeuthich')->insert($data);
                $notification['status']=1;
                // echo json_encode(1); //Nếu sản phẩm chưa có trong DB -> thêm vào
                
            }else{
                $notification['status']=2;
                // echo json_encode(2); //Nếu đã có trong DB yêu thích
            } 
        }else{
            $notification['status']=3;
            // echo json_encode(3); //Nếu chưa đăng nhập
        }
        
        echo json_encode($notification);
    }

    //Chuyển trang sp yêu thích
    public function wish_list(Request $re){
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();
        //Seo
        $meta_desc="";
        $meta_keywords="Trang yêu thích";
        $meta_tittle="Wish List";
        $url=$re->url();
        // end seo
        $all_wish_list=array();
        $MSKH=Session::get('user_id');

        if ($MSKH) {
            $all_wish_list= DB::table('yeuthich')->where('MSKH',$MSKH)
            ->join('sanpham', 'sanpham.MSSP', '=', 'yeuthich.MSSP')->get();
        }
        
        return view('User.Product.wishlist')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('wish_list',$all_wish_list);
    }

    public function delete_wishlist(Request $re){
        $Ma= $re->Ma;
        DB::table('yeuthich')->where('Ma',$Ma)->delete();
    }
}

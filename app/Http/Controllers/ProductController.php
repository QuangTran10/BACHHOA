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

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
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
        $all_product = DB::table('sanpham')->Paginate(5);
        
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
        DB::table('sanpham')->where('MSSP',$id)->update(['TrangThai'=>0]);
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
            $a = DB::table('sanpham')->where('MSSP', $value->MSSP)->get('TenSP')->first();
            $labels[]=$a->TenSP;
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
        ->with('related_product',$related_product)->with('url',$url)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
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
        ->with('url',$url)->with('wish_list',$all_wish_list);
    }

    public function delete_wishlist(Request $re){
        $Ma= $re->Ma;
        DB::table('yeuthich')->where('Ma',$Ma)->delete();
    }

    public function product_discount(Request $re){
        $all_category = DB::table('danhmuc')->get();
        $loaihang = DB::table('loaihang')->get();

        if (isset($_GET['sort_by'])) {

            $sort_by= $_GET['sort_by'];

            if($sort_by=='az'){

                $category_by_id =DB::table('sanpham')->where('sanpham.GiamGia', '>', 0)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('TenSP','ASC')->Paginate(9);

            }elseif ($sort_by=='za') {

                $category_by_id =DB::table('sanpham')->where('sanpham.GiamGia', '>', 0)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('TenSP','DESC')->Paginate(9);

            }elseif ($sort_by=='increase') {

                $category_by_id =DB::table('sanpham')->where('sanpham.GiamGia', '>', 0)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('Gia','DESC')->Paginate(9);

            }elseif ($sort_by=='decrease') {

                $category_by_id =DB::table('sanpham')->where('sanpham.GiamGia', '>', 0)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('Gia','ASC')->Paginate(9);
            }elseif ($sort_by=='price') {
                $nho=0;
                $lon=500000;
                if(isset($_GET['MAX']) && isset($_GET['MIN'])){
                    $nho = $_GET['MIN'];
                    $lon = $_GET['MAX'];
                }

                $category_by_id =DB::table('sanpham')->where('sanpham.GiamGia', '>', 0)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->whereBetween('sanpham.Gia', [$nho, $lon])->Paginate(9);

            }
            else{
                $category_by_id =DB::table('sanpham')->where('sanpham.GiamGia', '>', 0)
                ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
                ->orderBy('MSSP','ASC')
                ->Paginate(9);
            }
        }else{
            $category_by_id =DB::table('sanpham')->where('sanpham.GiamGia', '>', 0)
            ->join('danhmuc', 'sanpham.MaDM', '=', 'danhmuc.MaDM')
            ->orderBy('MSSP','ASC')
            ->Paginate(9);
        }

        //Seo
        $meta_desc="Giảm Giá Trong Tuần";
        $meta_keywords="Product";
        $url=$re->url();


        return view('User.Product.show_product')
        ->with('category',$all_category)->with('list',$loaihang)
        ->with('product',$category_by_id)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('url',$url);
    }
}

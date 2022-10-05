<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;
use Session;
use Auth;
session_start();

class DeliveryController extends Controller
{
    //Admin


    //User
    //Load tỉnh thành phần add_address
    public function select_delivery(Request $re){
    	$data = $re->all();
    	$output = "";
    	if($data['action']){
            $output .= '<option>Chọn</option>';
    		if($data['action'] == 'province'){
    			$select_district = DB::table('quanhuyen')->where('matp',$data['maid'])->orderBy('maqh','ASC')->get();
    			foreach ($select_district as $key => $district) {
    				$output .= '<option value = "'.$district->maqh.'">'.$district->name.'</option>';
    			}

    		}else if($data['action'] == 'district'){
    			$select_hamlet = DB::table('xaphuongthitran')->where('maqh',$data['maid'])->orderBy('xaid','ASC')->get();
    			foreach ($select_hamlet as $key => $hamlet) {
    				$output .= '<option value = "'.$hamlet->xaid.'">'.$hamlet->name.'</option>';
    			}

    		}
    	}
    	
    	echo $output;
    }

    //Load tỉnh thành phần update_address
    public function select_update_delivery(Request $re){
        $data = $re->all();
        $output = "";
        if($data['action']){
            $output .= '<option>Chọn</option>';
            if($data['action'] == 'update_province'){
                $select_district = DB::table('quanhuyen')->where('matp',$data['maid'])->orderBy('maqh','ASC')->get();
                foreach ($select_district as $key => $district) {
                    $output .= '<option value = "'.$district->maqh.'">'.$district->name.'</option>';
                }

            }else if($data['action'] == 'update_district'){
                $select_hamlet = DB::table('xaphuongthitran')->where('maqh',$data['maid'])->orderBy('xaid','ASC')->get();
                foreach ($select_hamlet as $key => $hamlet) {
                    $output .= '<option value = "'.$hamlet->xaid.'">'.$hamlet->name.'</option>';
                }

            }
        }
        
        echo $output;
    }

    //Lấy phâng đã selected trong tỉnh thành phố
    public function get_delivery(Request $re){
        $data = $re->all();
        $output = "";

        if($data['option'] == 'district'){
            $select_district = DB::table('quanhuyen')->where('matp',$data['ma_id'])->orderBy('maqh','ASC')->get();
            foreach ($select_district as $key => $district) {
                if($district->maqh == $data['is_district']){
                    $output .= '<option value = "'.$district->maqh.'" selected>'.$district->name.'</option>';
                }else{
                    $output .= '<option value = "'.$district->maqh.'">'.$district->name.'</option>';
                }
            }

        }else{
            $select_hamlet = DB::table('xaphuongthitran')->where('maqh',$data['ma_id'])->orderBy('xaid','ASC')->get();
            foreach ($select_hamlet as $key => $hamlet) {
                if($hamlet->xaid == $data['is_hamlet']){
                    $output .= '<option value = "'.$hamlet->xaid.'" selected>'.$hamlet->name.'</option>';
                }else{
                    $output .= '<option value = "'.$hamlet->xaid.'">'.$hamlet->name.'</option>';
                }
                
            }

        }

        echo $output;
    }
}

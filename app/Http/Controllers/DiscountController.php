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

class DiscountController extends Controller
{
    //admin
	public function show_discount(){
		Session::put('page',10);

		return view('admin.Discount.show_discount');
	}

    //user
}

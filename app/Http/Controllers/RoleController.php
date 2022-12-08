<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use App\Models\Staff;
use App\Models\Roles;
use Auth;
use Session;

class RoleController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
          return Redirect::to('dashboard');
      }else{
          return Redirect::to('admin')->send();
      }
    }

    public function role_management(){
        $this->AuthLogin();
    	$roles = Staff::with('roles')->get();

    	Session::put('page',11);
    	return view('admin.Role.role_management', compact('roles'));
    }

    public function assign_role(Request $request){
    	$data = $request->all();
    	$admin_id = Session::get('admin_id');

    	if($admin_id != $data['MSNV']){
    		$staff = Staff::where('MSNV', $data['MSNV'])->first();

    		$staff->roles()->detach();

    		if($data['role_admin'] == 'true'){
    			$staff->roles()->attach(Roles::where('quyen','admin')->first());
    		}

    		if($data['role_staff'] == 'true'){
    			$staff->roles()->attach(Roles::where('quyen','staff')->first());
    		}

    		if($data['role_stock'] == 'true'){
    			$staff->roles()->attach(Roles::where('quyen','stock')->first());
    		}
            echo 1;
    	}else{
    		echo 0;
    	}

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;                               //all 4 to be used for session 
use Session;                          //and request and redirec
use App\Http\Requests;                //
use Illuminate\Support\Facades\Redirect;

session_start();
class SuperAdminController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();//this will check
        return view('admin.dashboard');
    }

    public function logout()
    {
      //Session::put('admin_name',null);//both working
      //Session::put('admin_id',null);//both working
      Session::flush();//only this can be used for above 2
      return Redirect::to('/admin');
    }

    public function AdminAuthCheck()
    {//check video 25/part23
        $admin_id=Session::get('admin_id');
        if($admin_id){
          return;
        } else{
          return Redirect::to('/admin')->send();
        }
    }
}

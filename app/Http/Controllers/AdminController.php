<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//use App\Http\Controllers\Request;//not to be used gives error for controller
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    public function index()
    {
        return view('admin_login');
    }


    public function dashboard(Request $request)
    {
        $admin_email=$request->admin_email;
       // $admin_password=md5($request->admin_password);
          $admin_password=$request->admin_password;
        $result=DB::table('admin')
                     ->where('admin_email',$admin_email)
                     ->where('admin_password',$admin_password)
                     ->first();
                      /*echo "<pre>";
                      print_r($result);
                      echo "</pre>";
                      exit();*/
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
              Session::put('message','Email or password Invalid');
              return Redirect::to('/admin');
        }
        //echo "ok";*/
    }
}

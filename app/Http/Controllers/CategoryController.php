<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;                               //all 4 to be used for session t
use Session;                          //and request and redirec
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

class CategoryController extends Controller
{
    public function index()
    {
      $this->AdminAuthCheck();
      return view('admin.add_category');
    }

    public function all_category()
    {
      $this->AdminAuthCheck();// from SuperAdminController
      $all_info=DB::table('category')->get();
      $manage_category=view('admin.all_category')
      ->with('all_info',$all_info);
      return view('admin_layout')
            ->with('admin.all_category',$manage_category) ;
    }

    public function save_category(Request $request)
    {
      $data=array();
      $data['category_id']=$request->category_id;
      $data['category_name']=$request->category_name;
      $data['category_description']=$request->category_description;
      $data['publication_status']=$request->publication_status;
      //echo "<pre>";
      //print_r($data);
      //echo "</pre>";
      DB::table('category')->insert($data);
      Session::put('message','Category added sucessfully !!');
      return Redirect::to('/add-category');
    }

    public function unactive_category($category_id)
    {
      DB::table('category')
      ->where('category_id',$category_id)
      ->update(['publication_status' => 0]);
      Session::put('message','Category Unactive sucessfully !!');
      return Redirect::to('/all-category');
    }

    public function active_category($category_id)
    {
      DB::table('category')
      ->where('category_id',$category_id)
      ->update(['publication_status' => 1]);
      Session::put('message','Category active sucessfully !!');
      return Redirect::to('/all-category');
    }

    public function edit_category($category_id)
    {
      //return View('admin.edit_category');
      $this->AdminAuthCheck();
      $category_info=DB::table('category')
        ->where('category_id',$category_id)
        ->first();
      $category_info=view('admin.edit_category')
        ->with('category_info',$category_info);
        return view('admin_layout')
              ->with('admin.edit_category',$category_info);
    }

    public function update_category(Request $request,$category_id)
    {
      $data=array();
      //$data['category_name']=$request->category_name;
      $data['category_description']=$request->category_description;
      //print_r($data);
      DB::table('category')
      ->where('category_id',$category_id)
      ->update($data);

      Session::get('message','Category Updated successfully !');
      return Redirect::to('/all-category');
    }

    public function delete_category($category_id)
    {
      //echo $category_id;
      DB::table('category')
      ->where('category_id',$category_id)
      ->delete();
      Session::get('message','Category Deleted successfully !');
      return Redirect::to('/all-category');
    }

    public function AdminAuthCheck()
    {//from SuperadminController
        $admin_id=Session::get('admin_id');
        if($admin_id){
          return;
        }
        else{
          return Redirect::to('/admin')->send();
        }
    }

}

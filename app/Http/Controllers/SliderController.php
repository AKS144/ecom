<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;                               //all 4 to be used for session t
use Session;                          //and request and redirec
use App\Http\Requests;                //
use Illuminate\Support\Facades\Redirect;

session_start();

class SliderController extends Controller
{
    public function index()
    {
      return view('admin.add_slider');
    }

    public function add_slider(Request $request)
    {

      $data=array();
      $data['publication_status']=$request->publication_status;

      $image=$request->file('slider_image');
      if($image)
      {
        $image_name=str_random(20);
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext;
        $upload_path='slider/';
        $image_url=$upload_path.$image_full_name;
        $success=$image->move($upload_path,$image_full_name);
        if($success){
            $data['slider_image']=$image_url;
            DB::table('sliders')->insert($data);
            Session::put('message','Slider added successfully!!');
            return Redirect::to('/add-slider');
            //echo "<pre>";
            //print_r($data);
            //echo "<pre>";
            //exit();
        }
      }
        $data['slider_image']='';
        DB::table('sliders')->insert($data);
        Session::put('message','Slider added successfully image!!');
        return Redirect::to('/add-slider');
    }

    public function all_slider()
    {
      //$this->AdminAuthCheck();// from SuperAdminController
      $all_info_slider=DB::table('sliders')->get();
      $manage_slider=view('admin.all_slider')
      ->with('all_info_slider',$all_info_slider);
      return view('admin_layout')
            ->with('admin.all_slider',$manage_slider);
    }

    public function unactive_slider($id)
    {
      DB::table('sliders')
      ->where('id',$id)
      ->update(['publication_status' => 0]);
      Session::put('message','sliders Unactive sucessfully !!');
      return Redirect::to('/all-slider');
    }

    public function active_slider($id)
    {
      DB::table('sliders')
      ->where('id',$id)
      ->update(['publication_status' => 1]);
      Session::put('message','Sliders active sucessfully !!');
      return Redirect::to('/all-slider');
    }

    public function delete_slider($id)
    {
      //echo $category_id;
      DB::table('sliders')
      ->where('id',$id)
      ->delete();
      Session::get('message','Slider Deleted successfully !');
      return Redirect::to('/all-slider');
    }
}

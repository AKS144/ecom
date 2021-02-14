<?php

namespace App\Http\Controllers;

use DB;                               //all 4 to be used for session t
use Session;                          //and request and redirec
use App\Http\Requests;                //
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    public function index()
    {
      return view('admin.add_manufacture');
    }

    public function all_manufacture()
    {
      $all_manu=DB::table('manufacture')->get();
      /*$manage_manufacture=view('admin.all_manufacture')
      ->with('all_manu',$all_manu);*/

      $manage_manufacture=view('admin.all_manufacture', ['al_manu'=>$all_manu]);
      /*return view('admin_layout')
            ->with('admin.all_manufacture',$manage_manufacture);*/

      return view('admin_layout', ['admin.all_manufacture'=> $manage_manufacture]);//othher method is written like this
    }

    public function save_manufacture(Request $request)
    {
      $data=array();
      $data['manufacture_id']=$request->manufacture_id;
      $data['manufacture_name']=$request->manufacture_name;
      $data['manufacture_description']=$request->manufacture_description;
      $data['publication_status']=$request->publication_status;

      DB::table('manufacture')->insert($data);
      Session::put('message','Manufacture added sucessfully !!');
      return Redirect::to('/add-manufacture');
    }

    public function delete_manufacture($manufacture_id)
    {
      DB::table('manufacture')
      ->where('manufacture_id',$manufacture_id)
      ->delete();
      Session::get('message','manufacture Deleted successfully !');
      return Redirect::to('/all-manufacture');
    }


    public function unactive_manufacture($manufacture_id)
    {
      DB::table('manufacture')
      ->where('manufacture_id',$manufacture_id)
      ->update(['publication_status' => 0]);
      Session::put('message','manufacture Unactive sucessfully !!');
      return Redirect::to('/all-manufacture');
    }

    public function active_manufacture($manufacture_id)
    {
      DB::table('manufacture')
      ->where('manufacture_id',$manufacture_id)
      ->update(['publication_status' => 1]);
      Session::put('message','manufacture active sucessfully !!');
      return Redirect::to('/all-manufacture');
    }

    public function edit_manufacture($manufacture_id)
    {
      //return View('admin.edit_category');
      $manufacture_info=DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->first();
      $manufacture_info=view('admin.edit_manufacture')
        ->with('manufacture_info',$manufacture_info);
        return view('admin_layout')
              ->with('admin.edit_manufacture',$manufacture_info);
    }

    public function update_manufacture(Request $request,$manufacture_id)
    {
      $data=array();
      //$data['category_name']=$request->category_name;
      $data['manufacture_description']=$request->manufacture_description;
      //print_r($data);
      DB::table('manufacture')
      ->where('manufacture_id',$manufacture_id)
      ->update($data);

      Session::get('message','manufacture Updated successfully !');
      return Redirect::to('/all-manufacture');
    }
}

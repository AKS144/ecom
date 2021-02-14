<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;                               //all 4 to be used for session t
use Session;                          //and request and redirec
use App\Http\Requests;                //
use Illuminate\Support\Facades\Redirect;

session_start();
class ProductController extends Controller
{
    public function __contruct()
    {
        $this->AdminAuthCheck();
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

    public function index()
    {
        $this->AdminAuthCheck();
      return view('admin.add_product');
    }

    public function all_product()
    {
        $this->AdminAuthCheck();
        $all_info = DB::table('products')
                ->join('category', 'products.category_id', '=', 'category.category_id')
                ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
                ->get();

                //echo "<pre>";
                //print_r($all_info);
                //echo "</pre>";
                //exit();

         $manage_product=view('admin.all_product')
         ->with('all_info',$all_info);
         return view('admin_layout')
               ->with('admin.all_product',$manage_product);

    }

    public function save_product(Request $request)
    {
      $data=array();
      //$data['product_id']=$request->product_id;//adding no difference we can add this like in others operation
      $data['product_name']=$request->product_name;
      $data['category_id']=$request->category_id;
      $data['manufacture_id']=$request->manufacture_id;
      $data['product_short_description']=$request->product_short_description;
      $data['product_long_description']=$request->product_long_description;
      $data['product_price']=$request->product_price;
      $data['product_size']=$request->product_size;
      $data['product_color']=$request->product_color;
      $data['publication_status']=$request->publication_status;

      $image=$request->file('product_image');
      if($image)
      {
        $image_name=str_random(30);
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext;
        $upload_path='image/';
        $image_url=$upload_path.$image_full_name;
        $success=$image->move($upload_path,$image_full_name);
        if($success){
            $data['product_image']=$image_url;
            DB::table('products')->insert($data);
            Session::put('message','Product added successfully!!');
            return Redirect::to('/add-product');
            //echo "<pre>";
            //print_r($data);
            //echo "<pre>";
            //exit();
        }
      }
        $data['products_image']='';
        DB::table('products')->insert($data);
        Session::put('message','Product added successfully image!!');
        return Redirect::to('/all-product');
     }

     public function unactive_product($product_id)
     {
       DB::table('products')
       ->where('product_id',$product_id)
       ->update(['publication_status' => 0]);
       Session::put('message','Product Unactive sucessfully !!');
       return Redirect::to('/all-product');
     }

     public function active_product($product_id)
     {
       DB::table('products')
           ->where('product_id',$product_id)
           ->update(['publication_status' => 1]);
       Session::put('message','Products active sucessfully !!');
       return Redirect::to('/all-product');
     }

     public function edit_product($product_id)
     {
       //return View('admin.edit_category');
       $product_info=DB::table('products')
         ->where('product_id',$product_id)
         ->first();
       $product_info=view('admin.edit_product')
         ->with('product_info',$product_info);
         return view('admin_layout')
               ->with('admin.edit_product',$product_info);
     }

     public function update_product(Request $request,$product_id)
     {
        //$this->AdminAuthCheck();
       $data=array();
       //$data['category_name']=$request->category_name;
       $data['product_description']=$request->product_description;
       //print_r($data);
       DB::table('products')
       ->where('product_id',$product_id)
       ->update($data);

       Session::get('message','Products Updated successfully !');
       return Redirect::to('/all-product');
     }

     public function delete_product($product_id)
     {
       //echo $category_id;
       $this->AdminAuthCheck();
       DB::table('products')
       ->where('product_id',$product_id)
       ->delete();
       Session::get('message','Product Deleted successfully !');
       return Redirect::to('/all-product');
     }

}

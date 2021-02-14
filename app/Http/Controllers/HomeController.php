<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use App\Http\Requests;                //
use Illuminate\Support\Facades\Redirect;
use Session;                          //and request and redirec
use DB;                               //all 4 to be used for session t
session_start();

class HomeController extends Controller
{
    public function index()
    {
      $all_pub_prod = DB::table('products')
              ->join('category', 'products.category_id', '=', 'category.category_id')
              ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
              ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
              ->where('products.publication_status',1)
              ->limit(9)
              ->get();

       $manage_product=view('pages.home')
       ->with('all_pub_prod',$all_pub_prod);
        return view('layout')
             ->with('pages.home',$manage_product);
        //return view('pages.home');
    }

    public function show_product_by_category($category_id)
    {   //echo $category_id;
      $product_by_category = DB::table('products')
              ->join('category', 'products.category_id', '=', 'category.category_id')
              //->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
              ->select('products.*', 'category.category_name')
              //->where('products.publication_status',1)
              ->where('category.category_id',$category_id)
              ->where('products.publication_status',1)
              ->limit(18)
              ->get();

       $manage_product_by_cat=view('pages.product_by_category')
       ->with('product_by_catu',$product_by_category);    //product_by_catu is same as foreach loop
        return view('layout')
             ->with('pages.product_by_category',$manage_product_by_cat);

    }

    public function show_product_by_manufacture($manufacture_id)
    {   //echo $category_id;
      $product_by_manufacture = DB::table('products')
              ->join('category', 'products.category_id', '=', 'category.category_id')
              ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
              ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
              ->where('manufacture.manufacture_id',$manufacture_id)
              ->where('products.publication_status',1)
              ->limit(18)
              ->get();

       $manage_product_manu=view('pages.product_by_manufacture')
       ->with('product_by_manufacture',$product_by_manufacture);
        return view('layout') //did error written admin_layout but hence
                              // error shows all_pub_prod aar not valid
             ->with('pages.home',$manage_product_manu);
    }

    public function product_details_by_id($product_id)
    { //echo $product_id;

      $product_by_id = DB::table('products')
              ->join('category', 'products.category_id', '=', 'category.category_id')
              ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
              ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
              ->where('products.product_id',$product_id)//made mistake here products.product_id withmanufacture.manufacture_id
                                                              //as foreach statement is not used product_details
              ->where('products.publication_status',1)
              ->first();

       $manage_product_details=view('pages.product_details')
       ->with('product_by_id',$product_by_id);
        return view('layout')
                ->with('pages.product_details',$manage_product_details);

    }
}

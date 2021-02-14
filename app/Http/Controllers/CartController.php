<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;                                //all 4 to be used for session
use Session;                          //and request and redirect
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Routing\Controller;
//use ShoppingCart;
use Cart;
//
session_start();


class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $qty=$request->qty=1; //great achievement put 1 set default value
        $product_id=$request->product_id;
        $product_info=DB::table('products')
            ->where('product_id', $product_id)
            ->first();
          $data['qty']=$qty;
          $data['id']=$product_info->product_id;
          $data['name']=$product_info->product_name;
          $data['price']=$product_info->product_price;
          $data['options']['image']=$product_info->product_image;

          Cart::add($data);
          return Redirect::to('/show-cart');
    }

      public function show_cart()
    {
      $all_pub_cart=DB::table('category')
                    ->where('publication_status',1)
                    ->get();

      $manage_category=view('pages.add_to_cart')
                ->with('all_pub_cart',$all_pub_cart);
            return view('layout')
                ->with('pages.add_to_cart',$manage_category);
    }

    public function delete_to_cart($rowId)
    {
      Cart::update($rowId,0);
      return Redirect::to('/show-cart');
    }

      public function update_cart(Request $request)
      {
        $qty=$request->qty;
        $rowId=$request->rowId;
        Cart::update($rowId,2);//  Cart::update($rowId,$qty);
      }
}

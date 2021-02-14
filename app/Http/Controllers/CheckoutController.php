<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\support\Facades\Redirect;
use Cart;

session_start();

class CheckoutController extends Controller
{
    public function login_check()
    {
      return view('pages.custlogin');
    }

    public function customer_registration(Request $request)
    {
        $data=array();
        //$data['customer_id']=$request->customer_id;
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['password']=md5($request->password);
        $data['mobile_number']=$request->mobile_number;

        $customer_id=DB::table('customer')
             ->insertGetId($data);

            /* echo "<pre>";
             print_r($customer_id);
             exit();*/
             Session::put('customer_id',$customer_id);
             Session::put('customer_name',$request->customer_name);
             return Redirect::to('/checkout');
    }

    public function customer_login(Request $request)
    {
        $customer_email=$request->customer_email;
        $password=md5($request->password);
        $result=DB::table('customer')
                  ->where('customer_email',$customer_email)
                  ->where('password',$password)
                  ->first();
                  //echo "<pre>";
                  //print_r($result);
                  //exit();
                  if($result){
                    Session::put('customer_id',$result->customer_id);
                    return Redirect::to('/checkout');
                  }
                  else{
                    return Redirect::to('/login-check');
                  }
    }

    public function customer_logout()
    {
         Session::flush();
         return Redirect::to('/');
    }

    public function manage_order()
    {
      $all_order_info=DB::table('order')
              ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
              ->select('order.*', 'customer.customer_name')
              ->get();
              //echo "<pre>";
              //print_r($all_order_info);
              //echo "</pre>";
              //exit();
       $manage_order=view('admin.manage_order')
       ->with('all_order_info',$all_order_info);
       return view('admin_layout')
             ->with('admin.manage_order',$manage_order); //
    }

    public function view_order()
    {
      $order_by_id=DB::table('order')
              ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
              ->join('order_details', 'order.order_id', '=', 'order_details.order_id')
              //->select('order.*', 'order_details.product_name,product_price,product_sales_quantity', 'customer.customer_name,mobile_number')
              ->join('shipping', 'order.shipping_id', '=', 'shipping.shipping_id')
              ->select('order.*', 'order_details.*', 'customer.*', 'shipping.*')
              ->first();

            /*  echo "<pre>";
              print_r($order_by_id);
              echo "</pre>";
              exit();*/

      $manage_order=view('admin.view_order')
       ->with('order_by_id',$order_by_id);
       return view('admin_layout')
             ->with('admin.view_order',$manage_order);

    }

    public function checkout()
    {
      return view('pages.checkout');
      /*$all_pub_cart=DB::table('category')
                    ->where('publication_status',1)
                    ->get();

      $manage_category=view('pages.payment')
                ->with('all_pub_cart',$all_pub_cart);
            return view('layout')
                ->with('pages.payment',$manage_category);//
          */
    }

    public function payment()
    {
        return view('pages.payment');
    }

    public function order_place(Request $request)
    {
        $payment_method=$request->payment_method;
        //$shipping_id=Session::get('shipping_id');
        //echo $payment_gateway;  //checking commented
        //echo "<pre>";
        //print_r($shipping_id);
        //echo "</pre>";

        $pdata=array();
        $pdata['payment_method']=$request->payment_method;
        $pdata['payment_status']='pending';

        $payment_id=DB::table('payments')
          ->insertGetId($pdata);

          //$contents=Cart::content();
          //echo "$contents";

          $odata=array();
          $odata['customer_id']=Session::get('customer_id');
          $odata['shipping_id']=Session::get('shipping_id');
          $odata['payment_id']=$payment_id;
          $odata['order_total']=Cart::total();
          $odata['order_status']='pending';

          $order_id=DB::table('order')
                    ->insertGetId($odata);

          $contents=Cart::content();
          $odata=array();

          foreach($contents as $cont)
          {
            $odata['order_id']=$order_id;
            $odata['product_id']=$cont->id;
            $odata['product_name']=$cont->name;
            $odata['product_price']=$cont->price;
            $odata['product_sales_quantity']=$cont->qty;

            DB::table('order_details')
                  ->insertGetId($odata);
          }

        if($payment_method=='handcash')
        {
          Cart::destroy();
          return view('pages.handcash');

        }elseif($payment_method=='paypal'){
          echo "paypal";

        }else{
          echo "not selected anything";
        }
    }

    private function sslapi()
    {

    }

    public function save_shipping_details(Request $request)
    {
        $data=array();
        //$data['shipping_id']=$request->shipping_id;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_first_name']=$request->shipping_first_name;
        $data['shipping_last_name']=$request->shipping_last_name;
        $data['shipping_address']=$request->shipping_address;
        $data['shipping_city']=$request->shipping_city;
        $data['shipping_mobile_number']=$request->shipping_mobile_number;
        //echo "<pre>";
        //print_r($data);
        //echo "</pre>";
        $shipping_id=DB::table('shipping')->insertGetId($data);
          Session::put('shipping_id',$shipping_id);
          return Redirect::to('/payment');
    }

}

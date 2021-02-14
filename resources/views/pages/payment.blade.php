
@extends('layout')
@section('content')
<!--<section id="cart_items">
    <div class="container">
      <div class="table-responsive cart_info">
      <table class="table table-condensed">
        <thead>
          <tr class="cart_menu">
            <td class="image"></td>
            <td class="description"></td>
            <td class="price"></td>
            <td class="quantity"></td>
            <td class="total"></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="cart_product">
              <a href=""><img src="images/cartone.png" alt=""></a>
            </td>
            <td>
              <h4><a href="">Color</a></h4>
              <p>Web</p>
            </td>
            <td class="cart_price">
              <p>rupy</p>
            </td>
            <td class="cart_quantity">
              <div class="cart_quantity_button">
                <a class="cart_quantity_up" href="">+</a>
                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                <a class="cart_quantity_down" href="">-</a>
              </div>
            </td>
            <td class="cart_total">
              <p class="cart_total_price">rupy</p>
            </td>
            <td class="cart_delete">
              <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>
  </section>-->

  <section id="cart_items">
    <div class="container col-sm-12">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Shopping Cart</li>
        </ol>
      </div>
      <div class="table-responsive cart_info">
      <!--?php
        //$contents=Cart::content();
        //echo "<pre>";
        //print_r($contents);
        //echo "</pre>";
      //  ? -->

        <table class="table table-condensed">
          <thead>

            <tr class="cart_menu">
              <td class="image">Item</td>
              <td class="description">Name</td>
              <td class="price">Price</td>
              <td class="quantity">Quantity</td>
              <td class="total">Total</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
              <?php foreach(Cart::content() as $conts) {?>
            <tr>
              <td class="cart_product">
                <a href=""><img src="{{ $conts->options->image }}" height="80px" width="80px" alt=""></a>
              </td>
              <td class="cart_description">
                <h4><a href="">{{$conts->name}}</a></h4>

              </td>
              <td class="cart_price">
                <p>{{ $conts->price }}</p>
              </td>
              <td class="cart_quantity">
                <div class="cart_quantity_button">
                <form action="{{ url('/update-cart') }}" method="post">
                  {{ csrf_field() }}
          <!--name=qty is made for value passing-->    <input class="cart_quantity_input" type="text" name="qty" value="{{ $conts->qty }}" autocomplete="off" size="2">
                  <input type="hidden" name="rowId" value="{{ $conts->rowId }}"><!--rowId is default value in cart-->
                  <input type="submit" name="submit" value="update" class="btn btn-sm btn-default">
                </form>
                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price">{{ $conts->total }}</p><!--total is default in cart-->
              </td>
              <td class="cart_delete">
                <a class="cart_quantity_delete" href="{{ URL::to('/delete-to-cart/'.$conts->rowId) }}"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <tr> <p class="alert-success">
               <?php
               $message=Session::get('message');
               if($message)
               {
                 echo $message;
                 Session::put('message',null);
               }
               ?>
             </p></tr>
          <?php }?>
          </tbody>
        </table>
      </div>
    </div>
</section> <!--/#cart_items-->

  <section id="do_action">
    <div class="container">
      <div class="heading">
<!--        <h3></h3>
        <p></p>
      </div>
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="">Home</a></li>
          <li class="active">Payment method</li>
        </ol>
      </div>
      <div class="paymentCont">
        <div class="headingWrap">
          <h3 class="headingTop text-center">Select your Payment Method</h3>
          <p class="text-center">Created with bootstrap button and using radio button</p>
        </div>

        <div class="paymentWrap">
          <div class="btn-group paymentBtnGroup btn-group-justified" data-toggled="buttons">
            <form action="" method="post">

              <label class="btn paymentMethod active">
                <div class="method visa"></div>
                <input type="radio" name="payment_gateway" value="Handcash" checked>
              </label>
              <label class="btn paymentMethod active">
                <div class="method master-card"></div>
                <input type="radio" name="payment_gateway" value="paypal">
              </label>
                <input type="submit" value="Done" class="btn btn-success">
                </form>
              </div>
        </div>
-->
      <form action="{{ url('/order-placed') }}" method="post">
        {{ csrf_field() }}
        <input type="radio" name="payment_method" value="handcash">Hand Cash<br>
        <input type="radio" name="payment_method" value="paypal">Paypal<br>
        <input type="submit" name="" value="Done">
      </form>
      </div>
    </div>
  </section>
@endsection

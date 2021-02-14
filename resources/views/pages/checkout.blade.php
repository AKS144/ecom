@extends('layout')
@section('content')

<section id="cart_items" style="height:">
  <div class="container">
    <div class="breadcrumbs">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Check out</li>
      </ol>
    </div><!--/breadcrums-->

    <div class="register-req">
      <p>Please fillup this form............</p>
    </div><!--/register-req-->

    <div class="shopper-informations">
      <div class="row">
        <div class="col-sm-6 clearfix">
          <div class="bill-to">
            <p>Shipping Details</p>
            <div class="form-one">
              <form action="{{url('/save-shipping-details')}}" method="post">
                  {{ csrf_field() }}
                <input type="text" name="shipping_email" placeholder="Email*">
                <input type="text" name="shipping_first_name" placeholder="First Name *">
                <input type="text" name="shipping_last_name" placeholder="Last Name *">
                <input type="text" name="shipping_mobile_number" placeholder="mobile_number *">
                <input type="text" name="shipping_address" placeholder="Address  *">
                <input type="text" name="shipping_city" placeholder="city *">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> <!--/#cart_items-->


@endsection

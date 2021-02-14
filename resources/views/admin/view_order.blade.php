@extends('admin_layout')
@section('admin_content')
<!--
<div class="row-fluid sortable">
  <div class="box span6">
    <div class="box-header">
      <h2><i class="halflings-icon align-justify"><i><span class="break"></span>Customer Details</h2>
    </div>
    <div class="box-content">
      <table class="table">
        <thead class="table">
          <tr>
            <th>Username</th>
            <th>Mobile</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> $order_by_id->customer_name }}</td>
            <td> $order_by_id->mobile_number }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
-->


<div class="row-fluid sortable">
<div class="box span12">
  <div class="box-header">
    <h2><i class="halflings-icon align-justify"></i><span class="break"></span>
      Shipping Details </h2>
  </div>
<div class="box-content">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Username</th>
          <th>Address</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Product Name</th>
          <th>Product price</th>
          <th>Product sales quantity</th>
          <th>Product sub Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>{{ $order_by_id->shipping_first_name }}</td>
          <td>{{ $order_by_id->shipping_address }}</td>
          <td>{{ $order_by_id->mobile_number }}</td>
          <td>{{ $order_by_id->shipping_email }}</td>
          <td>{{ $order_by_id->product_name }}</td>
          <td>{{ $order_by_id->product_price }}</td>
          <td>{{ $order_by_id->product_sales_quantity }}</td>
          <td>{{ $order_by_id->product_price*$order_by_id->product_sales_quantity }}</td>
        </tr>
        <tfoot>
        <tr>
          <?php
                $per = 8;
                $total = $order_by_id->order_total * ($per / 100);
                $num = $total + $order_by_id->order_total;
          ?>
          <td colspan="4">Total With vat: &nbsp;<strong>{{ $num }}</strong></td>
        </tr>
      </tfoot>
      </tbody>
    </table>
   </div>
  </div>
</div>
</div>

<!--
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="halflings-icon user"></i><span class="break"></span>Order Details</h2>
    </div>
  <div class="box-content">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Product Name</th>
          <th>Product price</th>
          <th>Product sales quantity</th>
          <th>Product sub Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td># $order_by_id->order_details_id }}</td>
          <td># $order_by_id->product_name }}</td>
          <td># $order_by_id->product_price }}</td>
          <td># $order_by_id->product_sales_quantity }}</td>
          <td># $order_by_id->product_price*$odata->product_sales_quantity }}</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <td colspan="4">Total With vat:</td>
          <td><strong># $order_by_id->order_total }}</strong></td>
        </tr>
      </tfoot>
    </table>
   </div>
  </div>
</div>-->
@endsection

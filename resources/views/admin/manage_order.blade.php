@extends('admin_layout');
@section('admin_content')

  <ul class="breadcrumb">
    <li>
      <i class="icon-home"></i>
      <a href="index.html">Home</a>
      <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">OrderOrder</a></li>
  </ul>
         <p class="alert-success">
           <?php
           $message=Session::get('message');
           if($message)
           {
             echo $message;
             Session::put('message',null);
           }
           ?>
         </p>

  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header" data-original-title>
        <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>

      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>

              <th>Customer Name</th>
              <th>Order Total</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          @foreach($all_order_info as $order )
          <tbody>
          <tr>
            <td class="center">{{ $order->customer_name }}</td>
            <td class="center">{{ $order->order_total }}</td>
            <td class="center">{{ $order->order_status }}</td>
            <td class="center">

                <a class="btn btn-danger" href="{{URL::to('/unactive-order/'.$order->order_id)}}">
                  <i class="halflings-icon white thumbs-down"></i>
                </a>

              {{--<a class="btn btn-success" href="{{URL::to('/active-order/'.$data->order_id)}}">
                <i class="halflings-icon white thumbs-up"></i>
              </a>--}}

              <a class="btn btn-info" href="{{URL::to('/view-order/'.$order->order_id)}}">
                <i class="halflings-icon white edit"></i>
              </a>
              <a class="btn btn-danger" href="{{URL::to('/delete-order/'.$order->order_id)}}" id="delete">
                <i class="halflings-icon white trash"></i>
              </a>
            </td>
          </tr>
        </tbody>
      @endforeach
        </table>
      </div>
    </div><!--/span-->
  </div><!--/row-->

@endsection

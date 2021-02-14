@extends('admin_layout')
@section('admin_content')

  <ul class="breadcrumb">
    <li>
      <i class="icon-home"></i>
      <a href="index.html">Home</a>
      <i class="icon-angle-right"></i>
    </li>
    <li>
      <i class="icon-edit"></i>
      <a href="#">Add Category</a>
    </li>
  </ul>

  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header" data-original-title>
        <h2><i class="halflings-icon edit"></i><span class="break"></span>Form Elements</h2>
        <div class="box-icon">
        </div>
      </div>

      <p class="alert-success">
        <?php
        $message=Session::get('message');
        if($message){
          echo $message;
          Session::put('message',null);
        }
        ?>
      </p>
      <div class="box-content">
        <form class="form-horizontal" action="{{ url('/save-category') }}" method="post">
          {{ csrf_field() }}
          <fieldset>

          <div class="control-group">
            <label class="control-label" for="date01">Category Name</label>
            <div class="controls">
            <input type="text" class="form-control" name="category_name">
            </div>
          </div>
          <div class="control-group hidden-phone">
            <label class="control-label" for="textarea2">Category Description</label>
            <div class="controls">
            <textarea class="cleditor" name="category_description" rows="3"></textarea>
            </div>

            <div class="control-group hidden-phone">
              <label class="control-label" for="textarea2">Publication status</label>
              <div class="controls">
                <input type="checkbox" name="publication_status" value="1">
              </div>

          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Add category</button>
            <button type="reset" class="btn">Cancel</button>
          </div>
          </fieldset>
        </form>

      </div>
    </div><!--/span-->

  </div><!--/row-->



@endsection

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
        <form class="form-horizontal" action="{{url('/save-product')}}" method="post" enctype="multipart/form-data">

          <fieldset>
          <div class="control-group">
            <label class="control-label" for="date01">Product Name</label>
            <div class="controls">
            <input type="text" class="form-control" name="product_name" required>
            </div>
          </div>

          <div class="control-group">
          <label class="control-label" for="selectError3">Product category</label>
          <div class="controls">
            <select id="selectError3" name="category_id" required>
              <option>Select category</option>
              <?php
               $all_publish_cat=DB::table('category')
                           ->where('publication_status',1)
                           ->get();
               foreach($all_publish_cat as $data3){?>
            <option value="{{ $data3->category_id }}">{{ $data3->category_name }}</option>
            <?php }?>
            </select>
          </div>
          </div>

          <div class="control-group">
          <label class="control-label" for="selectError3">Manufacture Name</label>
          <div class="controls">
            <select id="selectError3" name="manufacture_id" required>
            <option>Select Manufacture</option>
            <?php
             $all_publish_manu=DB::table('manufacture')
                         ->where('publication_status',1)
                         ->get();
             foreach($all_publish_manu as $data4){?>
          <option value="{{ $data4->manufacture_id }}">{{ $data4->manufacture_name }}</option>
          <?php }?>
            </select>
          </div>
          </div>

          <div class="control-group hidden-phone">
            <label class="control-label" for="textarea2">Product short Description</label>
            <div class="controls">
            <textarea class="cleditor" name="product_short_description" rows="3" required></textarea>
            </div>
          </div>
            <div class="control-group hidden-phone">
              <label class="control-label" for="textarea2">Product long Description</label>
              <div class="controls">
              <textarea class="cleditor" name="product_long_description" rows="3" required></textarea>
              </div>
            </div>
              <div class="control-group">
                <label class="control-label" for="date01">Product Price</label>
                <div class="controls">
                <input type="text" class="form-control" name="product_price">
              </div>
            </div>
              <div class="control-group">
                <label class="control-label" for="fileInput">Image</label>
                <div class="controls">
                <input class="input-file uniform_on" name="product_image" id="fileInput" type="file" required>
              </div>
            </div>
              <div class="control-group">
                <label class="control-label" for="date01">Product Size</label>
                <div class="controls">
                <input type="text" class="form-control" name="product_size" required>
              </div>
            </div>
              <div class="control-group">
                <label class="control-label" for="date01">Product Color</label>
                <div class="controls">
                <input type="text" class="form-control" name="product_color" required>
              </div>
            </div>

            <div class="control-group hidden-phone">
              <label class="control-label" for="textarea2">Publication status</label>
              <div class="controls">
                <input type="checkbox" name="publication_status" value="1" required>
              </div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Add Product</button>
            <button type="reset" class="btn">Cancel</button>
          </div>
          </fieldset>
        </form>

      </div>
    </div><!--/span-->

  </div><!--/row-->
@endsection

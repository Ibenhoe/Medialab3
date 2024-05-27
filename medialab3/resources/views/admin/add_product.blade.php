<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
        .div_left{
            margin-left: 20px;
        }

        label{
            display: inline-block;
            width: 200px;
        }
        .div_pad{
            padding: 10px;
        }
        .page-content {
          background-color: #2d3035;
        }



    </style>
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <div class="div_left">
            <h1 class="h2">Add Product</h1>
            
            <form action="{{url('store_product')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="div_pad">
                <label for="">Product Merk</label>
                <input type="text" name="product_merk">
            </div>

            
            <div class="div_pad">
                <label for="">Product Title</label>
                <input type="text" name="product_title">
            </div>

            
            <div class="div_pad">
                <label for="">Product quantity</label>
                <input value="1" type="number" name="product_quantity">
            </div>

            
            <div class="div_pad">
                <label for="">Product category</label>
                <select name="product_category" required >
                    <option >Select a Category</option>
                    @foreach($data as $data)
                    <option value="{{$data->id}}">{{$data->cat_title}}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="div_pad">
                <label for="">Product description</label>
                <textarea name="product_description" cols="30" rows="5"></textarea>
            </div>


            <div class="div_pad">
                <label for="">Product images</label>
                <input type="file" name="product_image">
            </div>

            
            <div class="div_pad">
                
                <input type="submit" value="Add product" class="btn btn-info">
            </div>


            






            </form>
          </div>

          </div>
        </div>
      </div>
      
    @include('admin.footer')
  </body>
</html>
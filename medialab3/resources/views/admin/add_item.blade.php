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
            
            <form action="{{url('store_item')}}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="div_pad">
                <label for="">Product name</label>
                <select name="product_name" required >
                    <option >Select a Category</option>
                    @foreach($data as $data)
                    <option value="{{$data->id}}">{{$data->cat_title}}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="div_pad">
                <label for="">SerialNumber</label>
                <textarea name="Serialnumber" cols="30" rows="5"></textarea>
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
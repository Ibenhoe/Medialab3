<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style>
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

            <div>
                <h1>Update product</h1>

                <form action="{{url('update_product', $data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="div_pad">
                    <label for="">Product brand</label>
                    <input type="text" name="product_merk" value="{{$data->Merk}}">
                    </div>

                    <div class="div_pad">
                    <label for="">Product title</label>
                    <input type="text" name="product_title" value="{{$data->title}}">
                    </div>

                    <div class="div_pad">
                    <label for="">Quantity</label>
                    <input type="number" name="product_quantity" value="{{$data->Quantity}}">
                    </div>

                    <div class="div_pad">
                        <label for="">Category</label>
                        <select name="product_category" required >
                            <option value="{{$data->category_id}}">{{$data->categorie->cat_title}}</option>
                            
                            @foreach($category as $category)
                            <option value="{{$category->id}}">{{$category->cat_title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div lass="div_pad">
                    <label for="">Product description</label>
                    
                    <textarea name="product_description" cols="30" rows="5">{{$data->description}}</textarea>
                    </div>

                    <div class="div_pad">
                        <label for="">Current product photo</label>
                        <img src="/producten_images/{{$data->product_img}}" style="width: 100px; height: 100px;">
                    </div>

                    <div class="div_pad">
                        <label for="">Update product photo</label>
                        <input type="file" name="product_image">
                    </div>

                    <div>
                        <label for=""> </label>
                        <input name="Update_product1" type="submit" value="Update product" class="btn btn-info">
                    </div>

                </form>
            </div>




          </div>
        </div>
      </div>
    @include('admin.footer')
  </body>
</html>
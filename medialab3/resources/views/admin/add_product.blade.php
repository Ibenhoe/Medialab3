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
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <!-- Product toevoegen -->
          <div class="div_left">
            <h1 class="h2">Product toevoegen</h1>
            
            <form action="{{url('store_product')}}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="div_pad">
                  <label for="">Product Merk</label>
                  <input type="text" name="product_merk" required>
              </div>

              <div class="div_pad">
                  <label for="">Product Titel</label>
                  <input type="text" name="product_title" required>
              </div>
              
              <div class="div_pad">
                  <label for="">Product categorie</label>
                  <select name="product_category" required >
                      <option >Select een Categorie</option>
                      @foreach($data as $data)
                      <option value="{{$data->id}}">{{$data->cat_title}}</option>
                      @endforeach
                  </select>
              </div>

              <div class="div_pad">
                  <label for="">Product beschrijving</label>
                  <textarea name="product_description" cols="30" rows="5" required></textarea>
              </div>

              <div class="div_pad">
                  <label for="">Product afbeelding</label>
                  <input type="file" name="product_image" required>
              </div>

              <!--Submit button -->
              <div class="div_pad">
                  <input type="submit" value="Product toevoegen" class="btn btn-info">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
      
    @include('admin.footer')
  </body>
</html>
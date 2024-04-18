<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')


    <style>
    
    </style>
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
    @include('admin.sidebar2')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <div >
                <h2>Update Category</h2>


                <form action="{{url('update_category', $data->id)}}" method="post">
                    @csrf
                    <label for="">Category name</label>
                    <input type="text" name="cat_name" value="{{$data->cat_title}}">
                    <input type="submit" class="btn btn-info" value="Update">

                </form>


            </div>





          </div>
        </div>
    </div>
        








    @include('admin.footer')
  </body>
</html>
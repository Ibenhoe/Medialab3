<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
    .center2
    {
      
      width: 33%;
      text-align: center;
      margin-top: 30px;
      border: 1px solid white;
    }
    th
    {
      background-color: skyblue;
      padding: 5px;
      color: white;
    }
    tr{
      border: 1px solid white;
      padding: 10px;
    }
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

            <div>
              @if(session()->has('message'))
                <div class="alert alert-success">
                  {{ session()->get('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >x</button>
                </div>
              @endif
            </div>

            <div >
              <h1>Add Category</h1>
              <form action="{{url('add_category')}}" method="Post" >
                @csrf
                <span style="padding-right: 15px;">
                <label >Category name</label>
                <input type="text" name="category" required>
                </span>
                <input class="btn btn-primary" type="submit" value="Add Category">
              </form>

              <div>
                <table class="center2">
                  <tr>
                    <th>Category name</th>
                    <th>Action</th>
                  </tr>
                  @foreach($data as $datas)
                  <tr>
                    <td>{{$datas->cat_title}}</td>
                    <td>
                      <a class="btn btn-info" href="{{url('cat_edit',$datas->id)}}">Edit</a>
                      <a onclick="confirmation(event)" class="btn btn-danger" href="{{url('cat_delete',$datas->id)}}">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </table>

              </div>
              {{$data->links()}}

            </div>

          </div>
        </div>
      </div>

      
      @include('admin.footer')

      <script type="text/javascript">
          function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
        swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this data!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willCancel) => {
            if (willCancel) {
              window.location.href = urlToRedirect
            }});
          }

      </script>
    
  </body>
</html>
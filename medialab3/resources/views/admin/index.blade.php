<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
      
        th{
            padding: 20px;
            font-weight: bold;
            font-size: 20px;
            border-bottom: 3px solid grey;
        }
        td{
            padding: 20px;
            border-bottom: 1px solid grey;
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
            <div class="table_request">
            <table >
              <tr>
                <th>User name</th>
                <th>Email</th>
                <th>Product title</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Product image</th>
                <th>Change status</th>
              </tr>

              @foreach($data as $borrow)
              <tr>
                <td>{{$borrow->user->name}}</td>
                <td>{{$borrow->user->email}}</td>
                <td>{{$borrow->product->Merk}} {{$borrow->product->title}}</td>
                <td>{{$borrow->product->Quantity}}</td>
                <td>{{$borrow->status}}</td>
                <td><img src="producten_images/{{$borrow->product->product_img}}" style="width: 100px; height: 100px;"></td>
                <td><a class="btn btn-warning" href="{{url('approved_product',$borrow->id)}}">Approved</a>
                    <a class="btn btn-danger" href="{{url('rejected_product',$borrow->id)}}">Rejected</a>
                    <a class="btn btn-info" href="{{url('returned_product',$borrow->id)}}">Returned</a>
                </td>


              </tr>
              @endforeach
            </table>
            </div>


          </div>
        </div>
      </div>
      
    @include('admin.footer')
  </body>
</html>
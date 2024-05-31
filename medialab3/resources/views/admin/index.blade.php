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
        .page-content {
          background-color: #2d3035;
        }
        .btn-btn-warning {
          color: white;
          background-color: green;
          padding: 5px 10px;
          border-radius: 5px;
          margin-bottom: 5px;
        }
        .btn-btn-warning:hover {
          color: white;
          text-decoration: none;
          filter: brightness(80%);
        }
        .btn-btn-danger {
          color: white;
          background-color: red;
          padding: 5px 10px;
          border-radius: 5px;
          margin-bottom: 5px;
        }
        .btn-btn-danger:hover {
          color: white;
          text-decoration: none;
          filter: brightness(80%);
        }
        .btn-btn-info {
          color: white;
          background-color: #f0ad4e;
          padding: 5px 10px;
          border-radius: 5px;
          margin-bottom: 5px;
        }
        .btn-btn-info:hover {
          color: white;
          text-decoration: none;
          filter: brightness(80%);
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
                <th>Gebruikernaam</th>
                <th>Email</th>
                <th>Product titel</th>
                <th>Serial nummer</th>
                <th>Hoeveelheid</th>
                <th>Status</th>
                <th>Product afbeelding</th>
                <th>Verander status</th>
              </tr>

              @foreach($data as $borrow)
              <tr>
                <td>{{$borrow->user->name}}</td>
                <td>{{$borrow->user->email}}</td>
                <td>{{$borrow->product->Merk}} {{$borrow->product->title}}</td>
                <td>{{$borrow->item->serial_number}}</td>
                <td>{{$borrow->product->getRemainingAttribute()}}</td>
                <td>{{$borrow->status}}</td>
                <td><img src="producten_images/{{$borrow->product->product_img}}" style="width: 100px; height: 100px;"></td>

                @if ($borrow->status == 'approved')
                    <td><a class="btn-btn-warning" disabled>Accepteren</a>
                      <a class="btn-btn-danger"disabled>Afwijzen</a>
                      <a class="btn-btn-info" href="{{url('returned_product',$borrow->id)}}">Terug gebracht</a></td>
                @elseif ($borrow->status == 'pending')
                    <td><a class="btn-btn-warning" href="{{url('approved_product',$borrow->id)}}">Accepteren</a>
                      <a class="btn-btn-danger" href="{{url('rejected_product',$borrow->id)}}">Afwijzen</a>
                      <a class="btn-btn-info" disabled>Terug gebracht</a></td>
                @endif
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